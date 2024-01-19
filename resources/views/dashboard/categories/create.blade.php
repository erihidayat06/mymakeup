@extends('dashboard.layout.main')

@section('container')
<div class="container mt-4">
    <div class="row col-lg-8">
        <form action="/dashboard/category" method="post" class="mb-5" enctype="multipart/form-data">
            @csrf
        <div class="mb-3">
            <label for="jns_makeup" class="form-label">Nama</label>
            <input type="text" class="form-control @error ('nama') is-invalid @enderror" id="jns_makeup" name="nama" value="{{ old('nama') }}">
            @error('nama')
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
             <label for="gambar" class="form-label">Gambar</label>
             <img class="img-preview img-fluid md-5 col-sm-3 mb-3">
             <input class="form-control  @error('gambar') is-invalid @enderror" type="file" name="gambar" id="gambar" onchange="previewImage()" >
            @error('gambar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tambah Categori</button>
        </form>
    </div>
</div>

@endsection