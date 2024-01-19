@extends('layouts.main')

@section('container')

@include('sweetalert::alert')

<div style="margin-top:35px" class="container">

{{-- looping Komentar --}}
<?php $nilai = 0; ?>
@foreach ($pilih->komentar as $komen)
    <?php $nilai = $nilai + $komen->rating ?>
@endforeach


<?php $a = count($pilih->transaksi) ?>
<?php $i = count($pilih->komentar) ?>

{{-- Tampilan Pilih --}}
<div style="border-radius:5px" class="row g-0 bg-light position-relative mt-2 shadow-sm">
  <div style="max-height:505px; overflow: hidden; " class="col-md-5 mb-md-0 p-md-4">
    <span type="button" data-bs-toggle="modal" data-bs-target="#pilih">
       <img  src="{{ asset('storage/' . $pilih->gambar) }}" width="100%" alt="...">
    </span> 
  </div>
  <div class="col-md-6 p-4 ps-md-0">
    <h2 class="mt-0 fw-bold">{{ $pilih->jns_makeup }}</h2>

  

@if ($nilai>1)
<div style="color:#676767;" class="mb-3 mt-3 col d-flex justify-content-start align-items-center fw-normal">
    <div class="ratings mr-2 fs-6 d-flex">
            <i class="{{ ($nilai/$i >= 1 ? 'text-warning bi bi-star-fill' :  'bi bi-star' )  }}"></i>
            <i class="{{ ($nilai/$i >= 2 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 1 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
            <i class="{{ ($nilai/$i >= 3 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 2 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
            <i class="{{ ($nilai/$i >= 4 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 3 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
            <i class="{{ ($nilai/$i >= 5 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 4 ? 'text-warning  bi bi-star-half' : 'bi bi-star' )) }} "></i>
        <span class="fw-bold">&nbsp;{{ round($nilai/$i , 1) }}</span>
        <span style="font-size: 12px; padding-bottom:1px" class="d-flex align-items-end">/5.0&nbsp;&nbsp;{{ formatAngka($nilai) }} Rating | {{ formatAngka($i) }} Ulasan | {{ formatAngka($a) }} pesanan</span>
    </div>
</div>
@else
<div style="color:#676767;"  class="col mt-3 d-flex justify-content-start align-items-center fw-normal">
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
    
    <p class="mt-5 text-muted">kategori</p>
    <h2>{{ $pilih->category->nama }}</h2>

    
    <p class="mt-5 text-muted">Harga</p>
    <div class="mb-4">
      <h1>Rp {{ number_format($pilih->harga,0,",",".")  }}</h1>
    </div>
{{-- akhir Tampilan Pilih --}}
    
@auth
<!-- Button trigger modal Pesan sekarang -->
<button style="padding: 0; width:100%; padding-top:3px" type="button" class="btn btn-main-color d-inline mt-5 mb-5" data-toggle="modal" data-target="#exampleModal">
  <h3>Pesan Sekarang</h3> 
</button>
@else
<a style="padding: 0; width:100%; padding-top:3px" href="/login" class="btn btn-main-color mt-5 mb-5">
  <h3>Pesan Sekarang</h3> </a>
@endauth
  </div>
</div>
{{-- Akhir Button trigger modal --}}

<!-- Modal Forum Pembelian-->
<div class="modal fade" id="exampleModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pembelian</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="/transaksi" method="post">
            @csrf
            <input type="hidden" value="{{ $pilih->toko->id }}" name="toko_id">
            <input type="hidden" value="{{ $pilih->id }}" name="pilihan_id">
            <div class="mb-3">
            <label for="jns_makeup" class="form-label">Jenis Makeup</label>
            <input type="text" id="jns_makeup" name="jns_makeup" value="{{ $pilih->jns_makeup }}" class="form-control" placeholder="{{ $pilih->jns_makeup }}" disabled>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control d-block" name="harga" placeholder="{{ $pilih->harga }}" value="{{ $pilih->harga }}" disabled>
            </div>
            <div class="mb-3">
                <label for="tgl_acara" class="form-label">Tanggal Acara</label>
                <input type="date" id="tgl_acara" class="form-control d-block @error('tgl_acara') is-invalid @enderror" value="{{ old('tgl_acara') }}" name="tgl_acara" required>
                 @error('tgl_acara')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="number" id="no_telp" class="form-control d-block @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required>
                 @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                 @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea style="font-size: 14px" class="form-control" name="alamat" class="d-block @error('no_telp') is-invalid @enderror" id="alamat" cols="45" rows="5" required 
                placeholder="Masukan Detail Alamat
(Desa/kelurahan, Rt, Rw, Kec, Kab/kota, nama dan nomor jalan, patokan jalan)">{{ old('alamat') }}</textarea>
                 @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-main-color">Lanjut Bayar</button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- Akhir Modal --}}

{{-- Toko --}}
<div class="card mt-2 shadow-sm">
  <div class="card-header fw-bold">
   <h2>Toko</h2> 
  </div>
  <div class="card-body ">
    <a class="text-decoration-none text-dark" href="/toko/{{ $pilih->toko->slug }}">
    @if (isset($pilih->toko->gambar))
    <div class="d-flex">
      <div class="p-2">
        <img class="border border-2 rounded-circle  border-dark" src=" {{ asset('storage/' . $pilih->toko->gambar ) }}" alt="" width="50px" height="50px"> 
      </div>
      <div>
        <span class="fw-bold fs-4">{{ $pilih->toko->nama_toko }}</span>
        <br>
        <span style="font-size: 12px">Kec.{{ $pilih->toko->kecamatan }}</span>
      </div>
    </div>
      
    @else
      <img class="border border-2 rounded-circle  border-dark" src="/img/default.png" alt="" width="40px" height="40px">  {{ $pilih->toko->nama_toko }}
    @endif
    </a>
    
    
  </div>
</div>
{{-- akhir Toko --}}

{{-- Deskripsi --}}
 <div class="card mt-2 shadow-sm">
  <div class="card-header fw-bold">
   <h2>Deskripsi</h2> 
  </div>
    <div class="card-body">
      <p class="card-text">{!! $pilih->deskripsi !!}</p>
    </div>
 </div>
{{-- Akhir Deskripsi --}}

{{-- Komentar --}}
 <div class="card mt-2 shadow-sm "  style="margin-bottom: 300px;">
  <div class="card-header fw-bold">
    <div class="row row-cols-1 row-cols-lg-2">
       <h2 class="col">Ulasan Pemesan</h2> 
    </div>
  </div>
    <div class="card-body col-lg-12">
    @if ($nilai > 1)
        <div style="color:#676767;" class="mb-3 col d-flex justify-content-start align-items-center fw-normal">
            <div class="ratings mr-2 fs-6 d-flex">
                    <i class="{{ ($nilai/$i >= 1 ? 'text-warning bi bi-star-fill' :  'bi bi-star' )  }}"></i>
                    <i class="{{ ($nilai/$i >= 2 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 1 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
                    <i class="{{ ($nilai/$i >= 3 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 2 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
                    <i class="{{ ($nilai/$i >= 4 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 3 ? 'text-warning  bi bi-star-half' : 'bi bi-star' ))  }}"></i>
                    <i class="{{ ($nilai/$i >= 5 ? 'text-warning bi bi-star-fill' : ($nilai/$i > 4 ? 'text-warning  bi bi-star-half' : 'bi bi-star' )) }} "></i>
                <span class="fw-bold">&nbsp;{{ round($nilai/$i , 1) }}</span>
                <span style="font-size: 12px; padding-bottom:1px" class="d-flex align-items-end">/5.0&nbsp;&nbsp;{{ formatAngka($nilai) }} Rating ({{ formatAngka($i) }} Ulasan)</span>
            </div>
        </div>
        @else
        <div style="color:#676767;"  class="col d-flex justify-content-start align-items-center fw-normal">
            <div class="ratings">
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
            </div>
             <span class="fw-bold">&nbsp;0</span>
                <span style="font-size: 12px; padding-top:2px" class="d-flex align-items-end">/5.0&nbsp;&nbsp;0 Rating 0 Ulasan</span>   
        </div>
        @endif


    @if ($i < 1)
        <hr>
        <div class="text-center">
          <span class="text-muted">Tidak Ada Komentar</span>
        </div> 
    @endif
      
  
{{-- Komentar --}}
@foreach ($pilih->komentar as $komen)
      <div class=" mt-2">   
          <div class="bg-light p-0 px-1">
            <div class="row row-cols-2">
                
              <div class="col">
                {{ $komen->user->name }}
              </div>
              <div class="col d-flex justify-content-end align-items-center">
                <div style="padding: 0 10px; color:#676767; font-size: 10px" class="ratings">
                    <i class="{{ ($komen->rating >= 1 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                    <i class="{{ ($komen->rating >= 2 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                    <i class="{{ ($komen->rating >= 3 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                    <i class="{{ ($komen->rating >= 4 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                    <i class="{{ ($komen->rating >= 5 ? 'text-warning bi bi-star-fill' : 'bi bi-star') }} "></i>
                    <span>/{{ $komen->rating }}</span>
                </div>
              </div>
            </div>
          </div>
        
        <div class="card-body p-2">
            <span style="font-size: 11px" class="text-muted">{{ date('d M Y H:i', strtotime($komen->created_at)) }}</span><br>   
            <span class="text-muted">{!! nl2br($komen->komentar) !!}</span>
            
        </div>
        <hr>
      </div>
@endforeach
    </div>
 </div>
</div>

{{-- modal gambar --}}
<div class="modal fade" id="pilih" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="gambar d-flex justify-content-center">
        <img width="60%" height="100%" src="{{ asset('storage/' . $pilih->gambar) }}" alt="">
        </div>
      </div>
    </div>
  </div>
</div>


 @error('no_telp')
<script>
  $('#exampleModal').modal();
</script>
@enderror

 @error('tgl_acara')
<script>
  $('#exampleModal').modal();
</script>
@enderror

 @error('alamat')
<script>
  $('#exampleModal').modal();
</script>
@enderror
@endsection
