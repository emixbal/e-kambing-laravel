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
}
