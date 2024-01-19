@extends('dashboard.layout.main')

@section('container')
<div class="container mt-4">
    <div class="row col-lg-8">
        <form action="/dashboard/category/{{ $category->slug }}" method="post" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
        <div class="mb-3">
            <label for="jns_makeup" class="form-label">Nama Category</label>
            <input type="text" value="{{ $category->nama }}" class="form-control @error ('jns_makeup') is-invalid @enderror" id="jns_makeup" name="nama">
            @error('jns_makeup')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" value="{{ $category->slug }}" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug">
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="hidden" name="gambarLama" value="{{ $category->gambar }}">
            @if ($category->gambar)
            <img src="{{ asset('storage/' . $category->gambar) }}" class="img-preview img-fluid md-5 col-sm-3 mb-3 d-block">
            @else
            <img class="img-preview img-fluid md-5 col-sm-3 mb-3">
            @endif

            <input class="form-control @error('gambar') is-invalid @enderror" type="file" name="gambar" id="gambar" onchange="previewImage()" >
            @error('gambar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Pilihan</button>
        </form>
    </div>
</div>


@endsection