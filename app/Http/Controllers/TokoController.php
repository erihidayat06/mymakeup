<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->is_admin == 1) {
            abort(403);
        }

        return view('buatToko.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->is_admin == 1) {
            abort(403);
        }

        $validateData = $request->validate([
            'nama_toko' => 'min:3',
            'no_telepon' => 'min:3',
            'domisili' => 'min:3',
            'kecamatan' => 'min:3',
            'alamat' => 'min:3',
            'user_id' => '',
        ]);

        $validateData['slug'] = $request->nama_toko;


        Toko::create($validateData);
        $toko = auth()->user()->toko->slug;
        return redirect("dashboard/profil/$toko/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show(Toko $toko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit(Toko $toko)
    {
        return view('dashboard.toko.index', [
            'toko' => auth()->user()->toko
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toko $toko)
    {
        $validateData = $request->validate([
            'nama_toko' => '',
            'alamat' => '',
            'bank' => '',
            'no_rekening' => '',
            'uang_digital' => '',
            'no_digital' => '',
            'nama_toko' => '',
            'whatsapp' => '',
            'domisili' => 'min:3',
            'kecamatan' => 'min:3',
        ]);


        if ($request->file('gambar')) {
            if ($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }
            $validateData['gambar'] = $request->file('gambar')->store('post-images');
        }

        if ($validateData) {

            Toko::where('id', $request->id)->update($validateData);

            return redirect()->back()->with('success', 'Profil Berhasil di Rubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toko $toko)
    {
        //
    }
}
