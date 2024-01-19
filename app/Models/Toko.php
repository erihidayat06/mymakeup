<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pilihan;
use App\Models\Komentar;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Toko extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function pilihan()
    {
        return $this->hasMany(Pilihan::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
}
