<?php

namespace App\Http\Controllers;

use Auth;
use \URL;
use App\Models\Kambing;
use App\Models\Medicine;
use App\Models\KambingMedicine;
use App\Models\KambingType;
use App\Models\BloodType;
use App\Models\KambingKandangHistory;
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

    public function create()
    {
        $kandangs = Kandang::all()->where("is_active", 1);
        $kambing_types = KambingType::all()->where("is_active", 1);
        $blood_types = BloodType::all()->where("is_active", 1);
        $kambings = Kambing::all()->where("is_active", 1);

        $pass = [
            "kandangs"=>$kandangs,
            "kambing_types"=>$kambing_types,
            "blood_types"=>$blood_types,
            "kambings"=>$kambings,
        ];

        return view('kambing/new_form', $pass);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required',
            'sex_radio' => 'required',
            'kandang_id' => 'required',
            'kambing_type_id' => 'required',
            'blood_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('kambings/new')
            ->withErrors($validator)
            ->withInput();
        }

        $year   = $request->year;
        $month  = $request->month;
        $day    = $request->day;

        if($year < 1950 || $year > date("Y")){
            return redirect('kambings/new')
            ->withErrors("Invalid tahun lahir")
            ->withInput();
        }
        if($month < 1 || $month > 12){
            return redirect('kambings/new')
            ->withErrors("Invalid bulan lahir")
            ->withInput();
        }
        if($day < 1 || $day > 31){
            return redirect('kambings/new')
            ->withErrors("Invalid tanggal lahir")
            ->withInput();
        }
        $now = date('Y-m-d H:i:s');
        $dob = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year));

        if($dob > $now){
            return redirect('kambings/new')
            ->withErrors("Tanggal lahir belum terjadi")
            ->withInput();
        }

        $kambing = new Kambing;

        $kambing->name = $request->name;
        $kambing->number = $request->number;
        $kambing->sex = $request->sex_radio;
        $kambing->birth_date = $dob;
        $kambing->kandang_id = $request->kandang_id;
        $kambing->kambing_type_id = $request->kambing_type_id;
        $kambing->blood_type_id = $request->blood_type_id;
        $kambing->description = $request->description;
        $kambing->created_at = date('Y-m-d H:i:s');
        $kambing->updated_at = date('Y-m-d H:i:s');
        $kambing->user_id = Auth::user()->id;

        try {
            $kambing->save();
        } catch (\Throwable $e) {
            return redirect('kambings/new')
            ->withErrors("Terjadi kesalahan")
            ->withInput();
        }
        return redirect('kambings');
    }

    public function detail(Request $request, $id)
    {
        $kambing = Kambing::where('number', $id)
        ->orWhere('id', $id)
        ->with('bloodType')
        ->with('kambingType')
        ->first();

        if(!$kambing)
        {
            return view('kambing/detail_404', $pass);
        }

        $medicines = Medicine::where('is_active', TRUE)->get();
        $kandangs = Kandang::where('is_active', TRUE)->get();

        $histrory_view = ($request->input('histrory_view'))?$request->input('histrory_view'):'';

        if(!$histrory_view){
            $histrory_view="medicine";
        }
        $medicine_history = [];
        if($histrory_view=="medicine"){
            $medicine_history = KambingMedicine::where('kambing_id', $id)
            ->orderBy('created_at', 'desc')
            ->with('medicine')
            ->with('petugas')
            ->get();
        }
        
        $kandang_history = [];
        if($histrory_view=="kandang"){
            $kandang_history = KambingKandangHistory::where('kambing_id', $id)
            ->orderBy('created_at', 'desc')
            ->with('kandang')
            ->with('petugas')
            ->get();
        }
        
        $pakan_history = [];
        if($histrory_view=="pakan"){
            
        }

        $pass = [
            "base_url"=>URL::current(),
            "histrory_view"=>$histrory_view,
            "kambing"=>$kambing,
            "medicines"=>$medicines,
            "kandangs"=>$kandangs,
            "medicine_history"=>$medicine_history,
            "kandang_history"=>$kandang_history,
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
                "data"=>(object)[]
            ]);
        }
        
        return response()->json([
            "message"=>"ok",
            "isValid"=>TRUE,
            "data"=>$kambing,
        ]);
    }

    public function addMedicineSave(Request $request){
        $validator = Validator::make($request->all(), [
            'kambingId' => 'required',
            'medicineId' => 'required',
            'medicineDosing' => 'required',
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
                'dosing' => $request->medicineDosing,
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

        $kkh = new KambingKandangHistory;
        $kkh->kambing_id = $request->kambingId;
        $kkh->kandang_id = $request->kandangId;
        $kkh->user_id = Auth::user()->id;

        try {
            $kambing->save();
            $kkh->save();
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
