{{-- navbar Toko --}}
<?php $nilai = 0; ?>
@foreach ($komentar as $komen)
    <?php $nilai = $nilai + $komen->rating ?>
@endforeach


<?php $a = count($toko->transaksi) ?>
<?php $i = count($komentar) ?>

<nav class="navbar bg-body-tertiary" id="navbar">
  <div class="container">
    <div class="d-flex justify-content-start">
    <a class="navbar-brand d-flex align-items-center" href="#">
    <div class="col col-md-1 ">
         @if (isset($toko->gambar))
         <img class="rounded-circle border border-5 border-light " src="{{ asset('storage/' . $toko->gambar) }}" alt="Bootstrap" width="100" height="100">
          @else
          <img class="rounded-circle border border-5 border-light " src="/img/default.png" alt="Bootstrap" width="100" height="100">
          @endif 
    </div>   
    </a>
    <div class="col text-light container">
        <ul class="list-unstyled">
            <li> <h2>{{ $toko->nama_toko }}</h2></li>
            <li style="width: 60%">  {!! $toko->alamat !!} </li>
            <li>
                @if ($nilai>1)
<div style="color:#ffffff;" class=" mt-2 col d-flex justify-content-start align-items-center">
    <div class="ratings mr-2 fs-6 d-flex">
            <i class="{{ ($nilai/$i >= 1 ? 'text-warning bi bi-star-fill' :  'bi bi-star' )  }}"></i>
            <i class="{{ ($nilai/$i >= 2 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 1 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
            <i class="{{ ($nilai/$i >= 3 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 2 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
            <i class="{{ ($nilai/$i >= 4 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 3 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
            <i class="{{ ($nilai/$i >= 5 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 4 ? 'text-warning  bi bi-star-half' : 'bi bi-star' )) }} "></i>    
    <span class="fw-bold">&nbsp;{{ round($nilai/$i , 1) }}</span>
    <span style="font-size: 12px; padding-top:1px" class="d-flex align-items-end">/5.0</span>
    </div>
    
</div>
<div class="mb-3 col d-flex justify-content-start align-items-center">
  <span style="font-size: 12px"> {{ formatAngka($nilai) }} Rating | {{ formatAngka($i) }} Ulasan | {{ formatAngka($a) }} pesanan</span>
</div>
        @else
<div style="color:#ffffff;"  class="col mt-2 d-flex justify-content-start align-items-center">
    <div class="ratings">
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
        <i class="bi bi-star"></i>
    </div>
    <span class="fw-bold">&nbsp;0</span>
    <span  style="font-size: 12px; padding-bottom:1px" class="review-count mt-1">/0 Rating | 0 Ulasan | {{ $a }} pesanan</span>        
</div>
@endif
            </li>
        </ul>
    </div>      
    </div>     
  </div>
</nav>