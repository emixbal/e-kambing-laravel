<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominal',
        'anggota_id',
        'transaction_type_id',
        'keterangan',
        'user_id',
        'new_saldo',
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, "user_id")
        ->withDefault();
    }
    public function type()
    {
        return $this->belongsTo(TransactionType::class, "transaction_type_id")
        ->withDefault();
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, "anggota_id")
        ->withDefault();
    }
}
