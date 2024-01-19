<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = 'Category';
        return view('dashboard.categories.index',[
            'judul' => $judul,
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
        return view('dashboard.categories.create');
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
            'nama' =>'required|max:255',
            'slug' => 'required|unique:pilihans',
            'gambar'=> 'image|file|max:10000',
        ]);

        
        if($request->file('gambar')){
            $validateData['gambar'] = $request->file('gambar')->store('post-images');
        }
        

        Category::create($validateData);

        return redirect('/dashboard/category')->with('success', 'Data Category Berhasil Di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('admin');
        return view('dashboard.categories.edit', [
          'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'nama' =>'required|max:255',
            'gambar' => 'image|file|max:10000',
        ];

        if($request->slug != $category->slug){
            $rules['slug'] = 'required|unique:pilihans';
        }

        
        $validateData = $request->validate($rules);

        if($request->file('gambar')){
            if($request->gambarLama){
                Storage::delete($request->gambarLama);
            }
            $validateData['gambar'] = $request->file('gambar')->store('post-images');
        }


        Category::where('id',$category->id)
                ->update($validateData);

        return redirect('/dashboard/category')->with('success', 'Data Category Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
         if($category->gambar){
            Storage::delete($category->gambar);
        }
        Category::destroy($category->id);
        return redirect('/dashboard/category')->with('success', 'Category Berhasil di Hapus');
    }
}
