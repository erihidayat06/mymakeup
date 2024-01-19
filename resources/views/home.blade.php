@extends('layouts.main')

@section('container')

{{-- jumbotron --}}
<div style="margin-top:15px;" class="jumbotron">
  <div class="img ">
    <img class="justify-content-center" style="margin-top: 50px" width="400px" src="/img/logo.png" alt="">
  </div>
  
</div>
{{-- akhir jumbotron --}}

{{-- category --}}
<div style="margin-bottom: 200px" class="container">
<div class="hr-category">
  <h1>Select Category</h1>
</div>

<div class="row row-cols-md-3 cols-md-4 g-4">
@foreach ($categories as $category)
<a class="text-decoration-none" href="/pilihan?category={{ $category->slug }}">
  <div class="col">
    <div class="card h-100  shadow">
    <div class="mx-2 my-2"  style="max-height: 150px; overflow:hidden;">
        <img width="200px" src="{{ asset('storage/' . $category->gambar) }}" class="card-img-top" alt="...">
     </div> 
        <div class="card-body">
        <h5 class="card-title text-center fs-4 text-dark fw-bold">{{ $category->nama }}</h5>
      </div>
    </div>
  </div>
</a>
@endforeach
</div>  
</div>
{{-- akhir category --}}

@endsection

