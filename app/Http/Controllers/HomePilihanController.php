<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Komentar;
use App\Models\Pilihan;
use App\Models\Transaksi;

class HomePilihanController extends Controller
{
    public function index()
    {
        $judul = '';
        $category = Category::all();
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $judul = 'in ' . $category->nama;
        }


        return view('pilihan', [
            'pilihan' => Pilihan::with(['komentar'])->latest()->filter(request(['category', 'cari']))
                ->paginate(18)->withQueryString(),
            'notif' => Transaksi::latest()->notifikasi()->get(),
            'category' => $category,
            'judul' => $judul,
            'categories' => Category::latest()->get(),
            'kategori' => Category::latest()->get(),
        ]);
    }

    public function show(Pilihan $pilihan)
    {

        return view('pilih', [
            'detail' => '',
            'pilih' => $pilihan,
            'notif' => Transaksi::latest()->notifikasi()->get(),
            'categories' => Category::all(),
        ]);
    }
}
