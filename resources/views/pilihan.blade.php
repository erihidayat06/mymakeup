@extends('layouts.main')    

@section('container')

<div style="margin-bottom: 300px; margin-top:30px" class="container">

@if (request('category'))
    <h3 class="mt-3 fw-bold">CATEGORY {{ $category->nama }}</h3>
@else
    <h3 class="mt-3 fw-bold">CATEGORY All</h3>
@endif

{{-- input Pencarian --}}
<form action="/pilihan">
@csrf
<div class="input-group mb-3 shadow-sm">
  @if (request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}">
  @endif
  <input type="text" class="form-control" name="cari" placeholder="Cari Makeup..." value="{{ request('cari') }}" autocomplete="off">
  <button class="btn btn-primary"  type="submit" id="button-addon2">Cari</button>
</div>
</form>

{{-- Navbar Category Pilihan --}}
<nav class="navbar bg-light mb-3 shadow-sm g-4">
  <form class="container justify-content-center">
    <ul id="nav-category" class="nav">
    @if (request('category'))
      <li class="nav-item my-1 fw-bold"><a href="/pilihan" class="text-decoration-none text-light mx-1 px-1 pb-1 rounded-1 border bg-dark" type="button">All</a></li>
    @else
      <li class="nav-item my-1 fw-bold"><a href="/pilihan" class="text-decoration-none text-light mx-1 px-1 pb-1 rounded-1 border bg-success" type="button">All</a></li>
    @endif
      
    {{-- Menampilkan category max 6 --}}
      
      @foreach ($kategori->take(6) as $kate)        
        @if (request('category') === $kate->slug)
        <li class="nav-item my-1"><a href="/pilihan?category={{ $kate->slug }}" class="text-decoration-none mx-1 px-1 pb-1 rounded-1 text-success border border-success" type="button">{{ $kate->nama }}</a></li>        
        @else
        <li class="nav-item my-1"><a href="/pilihan?category={{ $kate->slug }}" class="text-decoration-none mx-1 px-1 pb-1 rounded-1 text-body border border-body" type="button">{{ $kate->nama }}</a></li>
        @endif
      @endforeach
      
      

      {{-- Menampilkan category lainya --}}
     @if (count($kategori) > 6)
      <li><div class="btn-group text-body">
        <span class="dropdown-toggle mt-1 mx-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Lainnya
        </span>
        <ul class="dropdown-menu">
          @foreach ($kategori->skip(6) as $gori)
              @if (request('category') === $gori->slug)
               <li ><a style="width: 100%" class="dropdown-category dropdown-item text-success text-capitalize" href="/pilihan?category={{ $gori->slug }}">{{ $gori->slug }}</a></li>
              @else
               <li ><a style="width: 100%" class="dropdown-category dropdown-item text-capitalize" href="/pilihan?category={{ $gori->slug }}">{{ $gori->slug }}</a></li>
              @endif
             
          @endforeach
        </ul>
      </div></li>
     @endif
     </ul>
  </form>
</nav>
{{-- akhir Navbar Kategory Pilihan --}}


{{-- Colom Pilihan --}}
<div  class="row row-cols-2 row-cols-lg-6 g-4">
@foreach ($pilihan as $pilih)
  <div  class="col d-flex justify-content-center">  
    <div style="height: 320px; width:155px;" id="card-pesanan"  class="card">
      <a class="text-decoration-none" href="/pilih/{{ $pilih->slug }}">
    <div style="max-height: 150px; overflow:hidden">
         <img src="{{ asset('storage/' . $pilih->gambar) }}" class="card-img-top" alt="...">
    </div> 
    
      <div id="makeup-pilihan" class="card-body p-2 px-2">
        <h5 style="color: #231955" class="card-title fw-bold">{{ $pilih->jns_makeup }}</h5>    
      </div>
      <span>
        
        <?php 
    $nilai = 0;
    $i = 0; ?>
    @foreach ($pilih->komentar as $bintang)
        <?php 
        $i++;
        $nilai = $nilai + $bintang->rating; 
        ?>
    @endforeach

    <?php $a = count($pilih->transaksi) ?>
    

    @if ($nilai > 1)

        <div class="d-flex justify-content-between align-items-center">
            <div style="padding: 0 10px; color:#676767; font-size: 10px" class="ratings">
                <i class="{{ ($nilai/$i >= 1 ? 'text-warning bi bi-star-fill' :  'bi bi-star' )  }}"></i>
                <i class="{{ ($nilai/$i >= 2 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 1 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
                <i class="{{ ($nilai/$i >= 3 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 2 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
                <i class="{{ ($nilai/$i >= 4 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 3 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
                <i class="{{ ($nilai/$i >= 5 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 4 ? 'text-warning  bi bi-star-half' : 'bi bi-star' )) }} "></i>
  
                <br>
                <span style="font-size: 10px">{{ formatAngka($i) }} Ulasan | {{ formatAngka($a) }} Pesanan</span>
            </div>
        </div>
        @else
        <div class="d-flex justify-content-between align-items-center">
            <div style="padding: 0 10px; color:#676767; font-size: 10px" class="ratings">
                <i class="small bi bi-star"></i>
                <i class="small bi bi-star"></i>
                <i class="small bi bi-star"></i>
                <i class="small bi bi-star"></i>
                <i class="small bi bi-star"></i>
                <br>
                <span style="font-size: 10px">0 Ulasan | {{ formatAngka($a) }} Pesanan</span>
            </div>
        </div>
        @endif
      </span>
      <span style="margin-left: 12px; " class="small font-weight-bold">{{ $pilih->category->nama }}</span>
      <div style="margin-left: 12px; color:red"><span class="card-text fs-6 fw-bold">Rp {{ number_format($pilih->harga,0,",",".") }}</span></div>  
      <span style="margin-left: 12px;  color:#676767; font-size: 12px" class="text-capitalize">Kec {{ $pilih->toko->kecamatan }}</span>
    </a>
    </div>   
  </div>
  @endforeach
</div>


{{-- Akhir Colom Pilihan --}}


<div class="container mt-5">
{{ $pilihan->links() }}
</div>  

  
</div>



@endsection