@extends('toko.layouts.main')

@section('container')

{{-- Pilihan --}}
<div class="container">
  <div class="text-center mt-2">
    <h5>--Pilihan Makeup--</h5>
  </div>
</div>

<div class="container mt-4">
    {{-- Colom Pilihan --}}
    <div  class="row row-cols-2 row-cols-lg-6 g-4">
    @foreach ($pilihan as $pilih)
      
      <div  class="col d-flex justify-content-center">  
        <div style="height: 300px; width:155px;" id="card-pesanan"  class="card">
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
                    <span style="font-size: 1PP0px">{{ formatAngka($i) }} Ulasan | {{ formatAngka($a) }} Pesanan</span>
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
          <div style="padding: 0 10px; color:red"><p class="card-text fs-6 fw-bold">Rp {{ number_format($pilih->harga,0,",",".") }}</p></div>  
        </a>
        </div>   
      </div>
      @endforeach
    </div>
    
    
    {{-- Akhir Colom Pilihan --}}
</div>
@endsection