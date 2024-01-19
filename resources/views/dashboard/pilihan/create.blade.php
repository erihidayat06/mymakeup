@extends('dashboard.layout.main')

@section('container')
<div class="container mt-4">
    <div class="card col-lg-8">
        <div class="card-body">
            <div class="row ">
                <form action="/dashboard/pilihan" method="post" class="mb-5" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $toko->id }}" name="toko_id">
                <div class="mb-3">
                    <label for="jns_makeup" class="form-label">Jenis Makeup</label>
                    <input type="text" class="form-control @error ('jns_makeup') is-invalid @enderror" id="jns_makeup" name="jns_makeup" value="{{ old('jns_makeup') }}">
                    @error('jns_makeup')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control @error ('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category_id">
                @foreach ($categories as $category)
                @if(old('category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->nama }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                @endif
                @endforeach
                
                </select>
                </div>
        
                <div class="mb-3">
                     <label for="gambar" class="form-label">Gambar</label>
                     <img class="img-preview img-fluid md-5 col-sm-3 mb-3">
                     <input class="form-control  @error('gambar') is-invalid @enderror" type="file" name="gambar" id="gambar" onchange="previewImage()" >
                    @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input id="deskripsi" class="form-control @error ('deskripsi') is-invalid @enderror" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                    <trix-editor input="deskripsi"></trix-editor>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <button type="submit" class="btn btn-primary">Tambah Pilihan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection