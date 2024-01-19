<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Profil;
use Illuminate\Http\Request;

class AnalisController extends Controller
{
    public function index()
    {

        $bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan[] = count(Transaksi::bulan([$i])->get());
        }

        $tahun = [['Contry', 'Mhl']];
        $a = intval(date('Y')) - 5;
        for ($i = $a; $i <= intval(date('Y')); $i++) {
            $tahun[] = ["$i",  count(Transaksi::tahun([$i])->get())];
        }


        $this->authorize('admin');
        return view('dashboard.analis.index', [
            'allTransaksi' => auth()->user()->toko->transaksi,
            'cancel' => Transaksi::latest()->pesanancancel()->get(),
            'pesanan' => Transaksi::latest()->pesanan()->get(),
            'transaksi' => Transaksi::latest()->cancel()->get(),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'judul' => 'Analis',
            'profil' => Profil::get()[0]
        ]);
    }
}
