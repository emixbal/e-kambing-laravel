<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Anggota;

class DeveloperController extends Controller
{
    public function fetchAnggotas()
    {
        return response()->json([
            "sisa"=>1,
        ]);
    }
}
