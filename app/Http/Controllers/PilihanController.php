<?php

namespace App\Http\Controllers;

use App\Models\Pilihan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = 'Pilihan';
        $category = "Category";
        if (request('category')) {
            $category = "Category " . request('category');
        }
        $this->authorize('admin');
        return view('dashboard.pilihan.index', [
            'pilihans' => Pilihan::latest()->pilihan(request(['category', 'cari']))->paginate(10)->withQueryString(),
            'judul' => $judul,
            'category' => $category,
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('dashboard.pilihan.create', [
            'categories' => Category::all(),
            'toko' => auth()->user()->toko
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jns_makeup' => 'required|max:255',
            'category_id' => 'required',
            'slug' => 'required|unique:pilihans',
            'harga' => 'required',
            'gambar' => 'image|file|max:10000',
            'deskripsi' => 'required',
            'toko_id' => 'required'
        ]);


        if ($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('post-images');
        }


        Pilihan::create($validateData);

        return redirect('/dashboard/pilihan')->with('success', 'Data Pilihan Berhasil Di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function show(Pilihan $pilihan)
    {
        $this->authorize('admin');
        return view('dashboard.pilihan.show', [
            'pilihan' => $pilihan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pilihan $pilihan)
    {
        $this->authorize('admin');
        return view('dashboard.pilihan.edit', [
            'pilihan' => $pilihan,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pilihan $pilihan)
    {
        $this->authorize('admin');
        $rules = [
            'jns_makeup' => 'required|max:255',
            'category_id' => 'required',
            'harga' => 'required',
            'gambar' => 'image|file|max:10000',
            'deskripsi' => 'required'
        ];

        if ($request->slug != $pilihan->slug) {
            $rules['slug'] = 'required|unique:pilihans';
        }


        $validateData = $request->validate($rules);

        if ($request->file('gambar')) {
            if ($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }
            $validateData['gambar'] = $request->file('gambar')->store('post-images');
        }


        Pilihan::where('id', $pilihan->id)
            ->update($validateData);

        return redirect('/dashboard/pilihan')->with('success', 'Data Pilihan Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pilihan  $pilihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pilihan $pilihan)
    {
        $this->authorize('admin');
        if ($pilihan->gambar) {
            Storage::delete($pilihan->gambar);
        }
        Pilihan::destroy($pilihan->id);
        return redirect('/dashboard/pilihan')->with('success', 'Pilihan Berhasil di Hapus');
    }
}
