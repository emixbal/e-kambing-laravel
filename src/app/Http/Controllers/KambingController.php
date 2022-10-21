<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Kambing;
use App\Models\Medicine;
use App\Models\KambingMedicine;
use App\Models\Kandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class KambingController extends Controller
{
    public function index(Request $request)
    {
        $kambings = Kambing::all();

        $pass = [
            "kambings"=>$kambings
        ];

        return view('kambing/index', $pass);
    }

    public function detail($id)
    {
        $kambing = Kambing::where('number', $id)
        ->orWhere('id', $id)
        ->with('bloodType')
        ->with('kambingType')
        ->first();

        if(!$kambing){
            return view('kambing/detail_404', $pass);
        }

        $medicines = Medicine::where('is_active', TRUE)->get();
        $kandangs = Kandang::where('is_active', TRUE)->get();

        $medicine_history = KambingMedicine::where('kambing_id', $id)
        ->orderBy('created_at', 'desc')
        ->with('medicine')
        ->with('petugas')
        ->get();


        $pass = [
            "kambing"=>$kambing,
            "medicines"=>$medicines,
            "kandangs"=>$kandangs,
            "medicine_history"=>$medicine_history,
        ];
        
        return view('kambing/detail', $pass);
    }
    
    public function detailPublic($id)
    {
        $kambing = Kambing::where('number', $id)
        ->orWhere('id', $id)
        ->with('bloodType')
        ->with('kambingType')
        ->first();

        $pass = [
            "kambing"=>$kambing,
        ];
        
        if(!$kambing){
            return view('kambing/detail_404', $pass);
        }
        
        return view('kambing/detail_public', $pass);
    }

    

    public function searchForm()
    {
        return view('kambing/search_form');
    }
    
    public function check($id)
    {
        $kambing = Kambing::where('number', $id)
        ->orWhere('id', $id)
        ->first();

        if(!$kambing){
            return response()->json([
                "message"=>"not found",
                "isValid"=>FALSE,
            ]);
        }
        
        return response()->json([
            "message"=>"ok",
            "isValid"=>TRUE,
        ]);
    }

    public function addMedicineSave(Request $request){
        $validator = Validator::make($request->all(), [
            'kambingId' => 'required',
            'medicineId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message"=>"nok",
                "data"=>(object)[],
            ]);
        }

        try {
            DB::table('kambing_medicines')->insert([
                'kambing_id' => $request->kambingId,
                'medicine_id' => $request->medicineId,
                'user_id' => Auth::user()->id,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "message"=>"nok",
                "err"=>$e,
                "data"=>(object)[],
            ]);
        }

        return response()->json([
            "message"=>"ok",
            "data"=>(object)[],
        ]);
    }

    public function pindahKandang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kambingId' => 'required',
            'kandangId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message"=>"nok",
                "err"=>"kambingId dan kandangId wajib diisi",
                "data"=>(object)[],
            ]);
        }

        $kambing = Kambing::find($request->kambingId);
        $kambing->kandang_id = $request->kandangId;

        try {
            $kambing->save();
        } catch (\Throwable $e) {
            return response()->json([
                "message"=>"nok",
                "err"=>$e,
                "data"=>(object)[],
            ]);
        }

        return response()->json([
            "message"=>"ok",
            "data"=>(object)[],
        ]);
    }

    
}
