<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KambingKandangHistory extends Model
{
    use HasFactory;

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, "kandang_id")
        ->withDefault();
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, "user_id")
        ->withDefault();
    }
}
