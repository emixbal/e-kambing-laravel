<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KambingMedicine extends Model
{
    use HasFactory;
    
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, "medicine_id")
        ->withDefault();
    }
    
    public function petugas()
    {
        return $this->belongsTo(User::class, "user_id")
        ->withDefault();
    }
}
