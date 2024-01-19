<?php

namespace App\Models;

use App\Models\Pilihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    
    public function pilihan()
    {
        return $this->hasMany(Pilihan::class);
    }

       public function getRouteKeyName()
    {
        return 'slug';
    }

}
