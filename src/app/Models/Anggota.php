<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $hidden = [
        'password',
    ];

    public function voucher()
    {
        return $this->hasOne(Voucher::class)->withDefault();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, "unit_id")->withDefault();
    }
    
    public function sumberGaji()
    {
        return $this->belongsTo(SumberGaji::class, "sumber_gaji_id")->withDefault();
    }
}
