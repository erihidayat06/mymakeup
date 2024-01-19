<?php

namespace App\Models;

use App\Models\Toko;
use App\Models\User;
use App\Models\Pilihan;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // relasi
    public function pilihan()
    {
        return $this->belongsTo(Pilihan::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
