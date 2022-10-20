<?php

namespace App\Http\Controllers;

use App\Models\Kambing;
use App\Models\Medicine;
use App\Models\KambingMedicine;
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

        $medicines = Medicine::where('is_active', TRUE)->get();

        $medicine_history = KambingMedicine::where('kambing_id', $id)
        ->with('medicine')
        ->get();


        $pass = [
            "kambing"=>$kambing,
            "medicines"=>$medicines,
            "medicine_history"=>$medicine_history,
        ];
        
        if(!$kambing){
            return view('kambing/detail_404', $pass);
        }
        
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
            return redirect("kambings/$id")
            ->withErrors($validator)
            ->withInput();
        }

        try {
            DB::table('kambing_medicines')->insert([
                'kambing_id' => $request->kambingId,
                'medicine_id' => $request->medicineId,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "message"=>"nok",
                "data"=>(object)[],
            ]);
        }

        return response()->json([
            "message"=>"ok",
            "data"=>(object)[],
        ]);
    }

    
}
