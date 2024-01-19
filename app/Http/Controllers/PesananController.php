<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Toko;
use App\Models\Transaksi;


class PesananController extends Controller
{
    public function index()
    {
        return view('pesanan.index', [
            'pesanan' => Transaksi::with(['pilihan', 'komentar'])->latest()->cancel()->get(),
            'notif' => Transaksi::latest()->notifikasi()->get(),
            'categories' => Category::all(),
        ]);
    }
}
