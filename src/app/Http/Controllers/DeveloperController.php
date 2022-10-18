<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Anggota;

class DeveloperController extends Controller
{
    public function fetchAnggotas($take)
    {
        $query = Anggota::whereNull('password');
        
        $query->take($take);
        
        $anggotas = $query->get();

        foreach ($anggotas as $anggota) {
            $dob = explode("-",$anggota->dob);
            $tanggal = $dob[2];
            $bulan = $dob[1];
            $tahun = $dob[0];

            $anggota->password = Hash::make($tanggal.$bulan.$tahun);
            
            $anggota->save();
        }

        $query2 = Anggota::whereNull('password');
        $sisa = $query2->count();

        return response()->json([
            "sisa"=>$sisa,
        ]);
    }
}
