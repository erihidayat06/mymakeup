<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;

class KomentarController extends Controller
{
    public function create(Request $request)
    {

        $validationData = $request->validate([
            'pilihan_id' => 'required',
            'toko_id' => 'required',
            'rating' => 'required',
            'komentar' => 'required|max:255',
            'transaksi_id' => 'required'

        ]);

        $validationData['user_id'] = auth()->user()->id;

        Komentar::create($validationData);

        return redirect('/pesanan')->with('success', 'Terimakasih Atas Penilaiannya');
    }
}
