<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kambing extends Model
{
    use HasFactory;

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class, "blood_type_id")
        ->withDefault();
    }
    
    public function kambingType()
    {
        return $this->belongsTo(KambingType::class, "kambing_type_id")
        ->withDefault();
    }
    
    public function kandang()
    {
        return $this->belongsTo(Kandang::class, "kandang_id")
        ->withDefault();
    }
}
