@extends('layouts.main')

@section('container')

@include('sweetalert::alert')



<div style="margin-top:20px; margin-bottom:300px;" class="container">
  <legend>Table Pesanan - {{ auth()->user()->name }}</legend>
<p class="alert alert-primary">Jika Status <span class="text-danger fw-bold"> Tunggu </span>Segera Lakukan Pembayaran Dengan Mengklik Tombol <span class="fw-bold">Bayar</span> </p>


<table class="table">
  <tbody>
<?php $i = 1?>
@foreach ($pesanan as $pesan)  
    <tr>
      <td>
{{-- Table Pemesanan --}}
<div style="overflow: hidden" class="card shadow-sm">
  <div class="nomor">
  {{ $i++ }}
  </div>
  <div class="row row-cols-2 row-cols-lg-2">
    <div style="max-width: 115px; padding-right:0" class="col-lg-2">
      <div style="max-height: 100px; overflow:hidden;">
        <img  width="90px"  src="{{ asset('storage/' . $pesan->pilihan->gambar) }}" alt="">
      </div>
    </div>


    {{-- Card Body Pemesanan --}}
      <div class="card-body">
        <span class="card-title"><a class="fw-bold text-decoration-none" href="/pilih/{{ $pesan->pilihan->slug }}">{{ $pesan->pilihan->jns_makeup }}</a></span>
        <div class="row row-cols-1 row-cols-lg-3">
        <div class="col">     
              <div class="row row-cols-2">
              <span class="col"><span style="font-size: 11px" class="text-muted">Tanggal Acara :</span><br><span style="font-size: 13px">{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}</span></span>
              <span class="col"><span style="font-size: 11px" class="text-muted">Tanggal Pesan :</span><br><span style="font-size: 13px">{{ date('d M Y', strtotime( $pesan->created_at)) }}</span></span>
              </div>    
        </div>
        <div class="col">    
            <span style="font-size: 11px" class="text-muted">Harga :</span><br> Rp{{ number_format($pesan->pilihan->harga,0,",",".")  }}  
        </div>    
        <div class="col">
            @if ($pesan->selesai == true)
              <span style="font-size: 11px" class="text-muted">Status :</span>
              <p style="color: green; font-weight: bold">Selesai</p>
            @elseif($pesan->acc_pesanan == true)
            <span style="font-size: 11px" class="text-muted">Status :</span>
              <p style="color: rgb(1, 1, 121); font-weight: bold">Proses</p>
            @else
              <span style="font-size: 11px" class="text-muted">Status :</span>
              <p style="color:red; font-weight: bold">Tunggu</p>
            @endif
        </div>
      </div>
     </div> 
</div>
 <hr style="margin: 0;"> 
<div class="col-lg-12 p-3 py-1">
  <div class="row row-cols-2">
  <div class="col">
    <div id="print"><a id="bi-print" href="/pesanan/{{ $pesan->no_pesanan }}" title="Print Pesanan" target="_blank" class="text-decoration-none" id="struk">print pesanan </a><i class="bi bi-printer"></i></div>
  </div>
  <div class="col d-flex justify-content-end">

  {{-- Pembayaran --}}
  <?php $bayar = "bayar" . $pesan->id ?>
  @if ($pesan->selesai == false)
      @if ($pesan->acc_pesanan == true)
      <a class="fw-bold btn btn-sm btn-danger" target="_blank" href="https://api.whatsapp.com/send?phone=6285647715796&text=*Pembatalan%20Pesanan*%0ANama%20:*%20{{ auth()->user()->name }}%0A*Jenis%20Makeup%20:*%20{{ $pesan->pilihan->jns_makeup }}%0A*Harga%20:*%20Rp%20{{ number_format($pesan->pilihan->harga,0,",",".")  }}%0A*Alamat%20:*%20{{ $pesan->alamat }}%0A*Tanggal%20Acara%20:*%20{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}%0A*Tanggal%20Pesanan%20:*%20{{ date('d M Y', strtotime( $pesan->created_at)) }}%0A*No%20Pesanan%20:*%20{{ $pesan->no_pesanan }}">Batalkan</a>
      @else
      <a class="fw-bold btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#{{ $bayar }}">Bayar</a>
      <form action="/transaksi/{{ $pesan->id }}" method="post">
        @csrf
        @method('delete')
      <button type="submit" style="margin-left: 10px" class="fw-bold btn btn-sm btn-danger" onclick="return confirm('Yakin Mau Di Batalkan')">Batalkan</button>
      </form>
      @endif
  @endif
            
    {{-- Akhir pembayaran --}}

    {{-- Rating --}}
    @if ($pesan->selesai == true)        
      @if (isset($pesan->komentar->first()->id))
      <?php $rating = "rating" . $pesan->id ?>

      <!-- Button trigger modal Rating -->
      <button style="margin-left: 10px" type="button" class="btn btn-sm btn-success text-light fw-bold" data-bs-toggle="modal" data-bs-target="#{{ $rating }}">
        Ulasan
      </button>
      <div class="modal fade" id="{{ $rating }}" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5>Rating Kamu</h5>
          <div class="d-flex justify-content-center align-items-center">
              <div style="padding: 0 10px; color:#676767; font-size: 30px" class="ratings">
                  <i class="{{ ($pesan->komentar->first()->rating >= 1 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 2 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 3 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 4 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 5 ? 'text-warning bi bi-star-fill' : 'bi bi-star') }} "></i>
              </div>
          </div>

          <h5 class="mt-3">Komentar</h5>
          <p>{!! nl2br($pesan->komentar->first()->komentar) !!}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @else
    <?php $komen = 'komen' . $pesan->id?>
      <!-- Button trigger modal Rating -->
        <a href="" style="margin-left: 10px" type="button" class="btn btn-sm btn-warning text-light fw-bold" data-bs-toggle="modal" data-bs-target="#{{ $komen }}">
          Beri ulasan
        </a>
      @endif
      
      @else
      <p></p>
      @endif            
    </div>
  </div>
</div>
  
  
 <!-- Modal Komentar-->
 <?php $komen = 'komen' . $pesan->id?>
<div class="modal fade" id="{{ $komen }}" tabindex="-1" aria-labelledby="{{ $komen }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fw-bold text-center">
        
        <form action="/komentar" method="post">
          @csrf
          <input type="hidden" value="{{ $pesan->id }}" name="transaksi_id">
          <input type="hidden" value="{{ $pesan->toko->id }}" name="toko_id">
          <input type="hidden" value="{{ $pesan->pilihan->id }}" name="pilihan_id">
          <div class="mb-3">
            <label for="bintang" class="form-label ">BERI NILAI</label>
            <div class="rate text-white">
                <div  class="rating"> 
                  <input type="radio" name="rating" value="5" id="{{ $komen . '5' }}"><label class="fs-1" for="{{ $komen . '5' }}" data-bs-toggle="tooltip" data-bs-title="Super Bagus">☆</label> 
                  <input type="radio" name="rating" value="4" id="{{ $komen . '4' }}"><label class="fs-1" for="{{ $komen . '4' }}" data-bs-toggle="tooltip" data-bs-title="Bagus">☆</label> 
                  <input type="radio" name="rating" value="3" id="{{ $komen . '3' }}"><label class="fs-1" for="{{ $komen . '3' }}" data-bs-toggle="tooltip" data-bs-title="B Aja">☆</label> 
                  <input type="radio" name="rating" value="2" id="{{ $komen . '2' }}"><label class="fs-1" for="{{ $komen . '2' }}" data-bs-toggle="tooltip" data-bs-title="Jelek">☆</label> 
                  <input type="radio" name="rating" value="1" id="{{ $komen . '1' }}"><label class="fs-1" for="{{ $komen . '1' }}" data-bs-toggle="tooltip" data-bs-title="Jelek Banget">☆</label>
                </div>    
            </div>
          </div>
          <div class="mb-3">
            <label for="komen" class="form-label">KOMENTAR</label>
            <textarea class="form-control" name="komentar" id="komen" cols="10" rows="5" placeholder="Beri Komentar untuk makeup {{ $pesan->pilihan->jns_makeup }}" required></textarea>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Beri Nilai</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
{{-- Akhir Modal Komentar --}}

<!-- Modal bayar-->
 <?php $bayar = 'bayar' . $pesan->id?>
<div class="modal fade" id="{{ $bayar }}" tabindex="-1" aria-labelledby="{{ $bayar }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pembayaran | <a class="text-decoration-none text-success" href="https://wa.me/62{{ substr($pesan->toko->whatsapp,1) }}"><i class="bi bi-whatsapp"></i> Hubungi Penjual</a></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form action="/bukti/{{ $pesan->id }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="mb-3">
            <span class="fw-bold">No Pesanan : {{ $pesan->no_pesanan }}</span>
            <p>--Pilih pembayaran--</p>
            <span class="fw-bold">Bank Transfer</span><br>
            @if (isset($pesan->toko->bank))   
            <p>{{ $pesan->toko->bank }} : {{ $pesan->toko->no_rekening }}</p>
            @else
            <p></p>
            @endif

            <span class="fw-bold">Uang Digital</span>
            @if (isset($pesan->toko->uang_digital))   
            <p>{{ $pesan->toko->uang_digital }} : {{ $pesan->toko->no_digital}}</p>
            @else
            <p></p>
            @endif

            <span class="fw-bold">Harga</span>
            <p class="fs-2">Rp {{ number_format($pesan->pilihan->harga,0,",",".")  }}</p>             

            <div class="mb-3">
              <?php $preview = "preview" . $pesan->id   ?>
              <?php $bukti = "buktibayar" . $pesan->id   ?>
              <?php $gambar = "gambar" . $pesan->id   ?>
              <?php $label = "label" . $pesan->id   ?>
              <label for="{{ $bukti }}" class="form-label">Lakukan pembayaran dan upload bukti transaksi</label>
              @if ($pesan->bukti)
                <label for="{{ $bukti }}" class="{{ $gambar }} gambarBukti">
                  <img style="width: 100%; margin:auto; padding: 0px 60px" src="{{ asset('storage/' . $pesan->bukti) }}" alt="" class="{{ $preview }} imgbayar  img-fluid">
                  <input type="hidden" name="gambarLama" value="{{ $pesan->bukti }}">
                  <img style="width: 100%; margin:auto; display:none; padding: 0px 60px" class="{{ $preview }} imgbayar  img-fluid ">
              @else
                  <label for="{{ $bukti }}" class="{{ $gambar }} gambarBayar">
                    <img style="width: 100%; margin:auto padding: 0px 60px" class="{{ $preview }} imgbayar  img-fluid ">
              @endif

             
                <div style="padding-top:45%"  class="middle ">
                  <div class="rubah fs-1">    
                    <i class="bi bi-cloud-download"></i>
                    <div class="p-2 fs-4">Rubah</div>
                  </div>
                </div>
              </label>

              <div class="{{ $label }} text-center">
                @if (!$pesan->bukti)
                <label for="{{ $bukti }}" class="buktibayar d-flex flex-column align-items-center justify-content-center fs-1">    
                  <i class="bi bi-cloud-download"></i>
                  <div class="p-2 fs-4">Kirim Bukti Bayar</div>
                </label>
                @endif
              </div>
              
              
              <input class="bukti form-control" name="bukti" type="file" id="{{ $bukti }}" onchange="gambarBukti({{ $pesan->id }})">
            
              @if (isset($pesan->toko->id))
              <input type="hidden" value="{{ $pesan->toko->id }}" name="toko_id">
              @endif
            </div>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
{{-- Akhir Modal bayar --}}
      </td>
      
    </tr>
    @endforeach
  </tbody>
</table>

{{-- Tidak Ada Pesanan --}}
@if (!isset($pesan->id))
  <div class="d-flex justify-content-center">
    <img style="opacity: 0.6" src="/img/pesanan.gif" alt="...." width="100px">
  </div>
  <div class="d-flex justify-content-center text-muted">
      <h2>Belum Ada Pesanan</h2> 
  </div>
@endif
</div>
</div>

<script>

function gambarBukti(id)
{
  const image = document.querySelector('#buktibayar' + id)
  const preview = document.querySelector('.preview' + id)
  const gambarBayar = document.querySelector('.gambar' + id)
  const label = document.querySelector('.label' + id)

  preview.style.display = 'block';
  gambarBayar.style.display = 'block';
  label.style.display = 'none';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent){
    preview.src = oFREvent.target.result;
  }
}

</script>


@endsection
