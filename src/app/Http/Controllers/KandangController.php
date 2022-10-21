<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandang;
use App\Models\Kambing;
use Auth;

class KandangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kandangs = Kandang::orderBy('name')->where('is_active', TRUE)->get();

        $pass = [
            "kandangs"=>$kandangs
        ];
        return view('kandang/index', $pass);
    }

    public function detail($id)
    {
        $kandang = Kandang::find($id)
        ->first();

        if(!$kandang){
            return view('kandang/detail_404');
        }

        $kambings = Kambing::orderBy('name')
        ->where('kandang_id', $id)
        ->where('is_active', TRUE)
        ->get();

        $pass = [
            "kandang"=>$kandang,
            "kambings"=>$kambings
        ];

        return view('kandang/detail', $pass);
    }
}
