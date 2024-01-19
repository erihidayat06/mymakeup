<?php

namespace App\Models;

use App\Models\Toko;
use App\Models\Category;
use App\Models\Komentar;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pilihan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['category', 'transaksi'];

    // scope
    public function scopeFilter($query, array $filters)
    {
        // $query->when($filters['category'] ?? false , function($query, $category){
        //     return $query->whereHas('category', function($query) use ($category){
        //         $query->where('slug', $category);
        // });
        // });

        $query->when(
            $filters['cari'] ?? false,
            fn ($query, $cari) =>
            $query->where('jns_makeup', 'like', '%' . $cari . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category)
            )
        );
    }

    public function scopePilihan($query, array $filters)
    {
        $query->when()->where('toko_id', auth()->user()->toko->id);
        $query->when(
            $filters['cari'] ?? false,
            fn ($query, $cari) =>
            $query->where('jns_makeup', 'like', '%' . $cari . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category)
            )
        );
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    // relasi

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
