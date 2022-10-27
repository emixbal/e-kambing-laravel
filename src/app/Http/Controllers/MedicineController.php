<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandang;
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
        $medicine = Kandang::orderBy('name')->where('is_active', TRUE)->get();

        $pass = [
            "medicine"=>$medicine
        ];
        return view('medicine/index', $pass);
    }
}
