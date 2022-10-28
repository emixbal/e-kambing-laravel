<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Kambing;
use Auth;

class MedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $medicines = Medicine::orderBy('name')->where('is_active', TRUE)->get();

        $pass = [
            "medicines"=>$medicines
        ];
        
        return view('medicine/index', $pass);
    }

    public function detail($id)
    {
        $medicine = Medicine::find($id)
        ->first();

        if(!$medicine){
            return view('medicine/detail_404');
        }

        $pass = [
            "medicine"=>$medicine,
        ];

        return view('medicine/detail', $pass);
        
    }
}
