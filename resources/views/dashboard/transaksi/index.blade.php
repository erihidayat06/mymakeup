@extends('dashboard.layout.main')

@section('container')

@include('sweetalert::alert')

<h1>{{ $judul }}</h1>

{{-- input Pencarian --}}
<form action="/dashboard/transaksi">
@csrf
<div class="input-group mb-3">
  <input type="text" class="form-control" name="cari" placeholder="Cari Transaksi" value="{{ request('cari') }}">
  <button class="btn btn-primary"  type="submit" id="button-addon2">Cari</button>
</div>
</form>


<div class="card text-center mb-3">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
         <a class="nav-link {{ ($active == 'cancel') ? 'active' : '' }} fw-bold" aria-current="page" href="/dashboard/transaksi?cancel=1">CANCEL</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ ($active == 'tunggu') ? 'active' : '' }} fw-bold" aria-current="page" href="/dashboard/transaksi?acc_pesanan=false&active=aktif&cancel=false">Tunggu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ ($active == 'sukses') ? 'active' : '' }} fw-bold" aria-current="page" href="/dashboard/transaksi?acc_pesanan=1&cancel=false&selesai=false">Sukses</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ ($active == 'selesai') ? 'active' : '' }} fw-bold" aria-current="page" href="/dashboard/transaksi?selesai=1">Selesai</a>
      </li>
    </ul>
  </div>
  <div class="card-body">


<div class="float-start">
  showing {{$transaksis->firstItem()}} to {{$transaksis->lastItem()}} of {{$transaksis->total()}} 
</div>
  
<div class="float-end">{{ $transaksis->links() }}</div><br><br>

<div class="table-responsive col-lg-12 mt-3  d-block">
  <table class="table table-striped text-start table-bordered table-sm">
    <thead>  
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Pilihan</th>
        <th scope="col">Harga</th>
        <th scope="col">Tanggal_Acara</th>
        <th scope="col">No_Telepon</th>
        <th scope="col">Alamat</th>
        <th scope="col">No_Pesanan</th>
        <th scope="col">Status</th>
        <th scope="col">________Action________</th>
      </tr>
      </thead>
      <tbody>

      <?php $i=1 ?>
      @foreach ($transaksis as $transaksi)
        
      <tr>
        <th scope="row"><?=$i++?></th>
        <td>{{ $transaksi->user->name }}</td>
        <td>{{ $transaksi->pilihan->jns_makeup }}</td>
        <td>{{ $transaksi->pilihan->harga }}</td>
        <td>{{ date('d M Y', strtotime($transaksi->tgl_acara)) }}</td>
        <td>{{ $transaksi->no_telp }}</td>
        <td>{!! $transaksi->alamat !!}</td>
        <td class="text-uppercase">{{ $transaksi->no_pesanan }}</td>
        <td>
          @if ($transaksi->selesai == true && $transaksi->acc_pesanan == true)
              <p style="color: rgb(12, 181, 0); font-weight: bold">Selesai</p>
          @elseif($transaksi->acc_pesanan == true)
              <p style="color: rgb(0, 38, 85); font-weight: bold">sukses</p>
          @else
              <p style="color:red; font-weight: bold">Tunggu</p>
          @endif
        </td>
        <td>

          @if ($transaksi->selesai == 0)
          {{-- Opsi --}}
          <div class="d-flex justify-content-start">
           {{-- Tombol Acc --}}
          @if ($transaksi->acc_pesanan)
            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf   
            <input type="hidden" name="acc_pesanan" value="{{ $transaksi->acc_pesanan }}">
            <input type="hidden" name="cancel" value="-">
            <input type="hidden" name="selesai" value="-">
            <button type="submit" class="badge m-1 mx-2 btn-warning px-2 text-dark">Batal</button>
            </form>
          
          @else
            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf
            
            @if ($transaksi->bukti)
            <button type="button" class="badge m-1 btn-secondary px-3" data-bs-toggle="modal" data-bs-target="#bukti{{ $transaksi->id }}">Bukti</button> 
            @endif
            <input type="hidden" name="cancel" value="-">
            <input type="hidden" name="selesai" value="-">
            <input type="hidden" name="acc_pesanan" value="{{ $transaksi->acc_pesanan }}">
            <button type="submit" class="badge m-1 btn-primary px-3">Acc</button>
            </form>
          @endif
          
            {{-- Tombol Cancel --}}
            @if ($transaksi->cancel == 1)
             <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf   
            <input type="hidden" name="cancel" value="{{ $transaksi->cancel }}">
             <input type="hidden" name="acc_pesanan" value="-">
             <input type="hidden" name="selesai" value="-">
          <button type="submit" class="badge m-1 btn-success">Kembalikan</button>
          </form>
            @else
            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf   
            <input type="hidden" name="cancel" value="{{ $transaksi->cancel }}">
             <input type="hidden" name="acc_pesanan" value="-">
             <input type="hidden" name="selesai" value="-">
          <button type="submit" class="badge m-1 btn-danger px-3">Cancel</button>
          </form>

            @if($transaksi->acc_pesanan == true)
            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf   
            <input type="hidden" name="sukses" value="{{ $transaksi->sukses }}">
             <input type="hidden" name="acc_pesanan" value="-">
             <input type="hidden" name="cancel" value="-">
          <button type="submit" onclick="return confirm('apakah sudah selesai?')" class="badge m-1 btn-success float-end px-3">Selesai</button>
          </form>
            @endif
            @endif
            </div>
          {{-- Akhir Opsi --}}
          @else
          <p  style="color: rgb(12, 181, 0); font-weight: bold" class="text-center align-items-center">Selesai</p>
          @endif
        </td>
      </tr>    
      
      

      <!-- Modal bukti pembayaran -->
<div class="modal fade" id="bukti{{ $transaksi->id }}" tabindex="-1" aria-labelledby="bukti{{ $transaksi->id }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="bukti{{ $transaksi->id }}Label">Bukti Pembayaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('storage/' . $transaksi->bukti) }}" width="100%" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

      @endforeach
      @if ($i == 1)
      <tr>
        <td colspan="10" class="text-center">Tidak Ada Transaksi</td>
      </tr>
      @endif
 
      </tbody>
    </table>
    
</div>
</div>
  </div>
</div>


@endsection