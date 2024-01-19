<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Pilihan;
use Illuminate\Http\Request;

class TokoviewController extends Controller
{
    public function index(Toko $toko)
    {

        return view('toko.index', [
            'toko' => $toko,
            'pilihan' => $toko->pilihan,
            'komentar' => $toko->komentar
        ]);
    }
}
