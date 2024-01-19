@extends('dashboard.layout.main')

@section('container')
    <div class="container mt-4">

    <div class="row col-lg-8">
        <div style="margin-top:20px; margin-bottom:300px;" class="container">
        <legend>Toko - {{ auth()->user()->name }}</legend>
        <p class="alert alert-primary">Pastikan Semua Data <span class="text-danger fw-bold"> Dilengkapi </span>Sebelum Melakukan <span class="fw-bold">Penjualan</span> </p>

        <form action="/dashboard/profil/{{ $toko->slug }}" method="post" class="mb-5" enctype="multipart/form-data">
            @csrf
            @method('put')

        <input type="hidden" value="{{ $toko->id }}" name="id">
        <div class="mb-3">
            <label for="nama_toko" class="form-label">Nama toko</label>
            <input type="text" class="form-control @error ('nama_toko') is-invalid @enderror" id="nama_toko" name="nama_toko" value="{{ $toko->nama_toko }}">
            @error('nama_toko')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">   
              <label for="logo" class="form-label">Logo</label><br>
              @if ($toko->gambar)
                <label for="logo" class="gambar gambarlogo1">
                  <img style="width: 200px; " src="{{ asset('storage/' . $toko->gambar) }}" alt="" class="tampil imgbayar  img-fluid">
                  <input type="hidden" name="gambarLama" >
                  <img style="width: 200px;  display:none;" class="tampil imgbayar  img-fluid ">
              @else
                  <label for="logo" class="gambar gambarlogo2">
                    <img style="width: 200px; margin:auto" class="tampil imgbayar  img-fluid ">
              @endif

             
                <div class="middle ">
                  <div class="rubah fs-1">    
                    <i class="bi bi-cloud-download"></i>
                    <div class="p-2 fs-4">Rubah</div>
                  </div>
                </div>
              </label>

              <div class="label text-center">
                @if (!$toko->gambar)
                <label for="logo" class="logo d-flex flex-column align-items-center justify-content-center fs-1">    
                  <i class="bi bi-cloud-download"></i>
                  <div class="p-2 fs-4">Kirim Logo</div>
                </label>
                @endif
              </div>
              
              
              <input class="bukti form-control" name="gambar" type="file" id="logo" onchange="gambarLogo()">
            
            </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input id="alamat" class="form-control @error ('alamat') is-invalid @enderror" type="hidden" name="alamat" value="{{ $toko->alamat }}">
            <trix-editor input="alamat"></trix-editor>
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

         <div class="mt-2">
            <label for="domisili" class="form-label">Domisili</label>
        <select class="form-select" aria-label="Default select example" name="domisili" id="domisili">   
            @if (isset($toko->domisili))
            <option selected>{{ $toko->domisili }}</option>
            @else
            <option selected>Domisilin</option>
            @endif
        </select>
        </div>

        <div class="mt-2">
            <label for="kecamatan" class="form-label">Kecamatan</label>
        <select class="form-select" aria-label="Default select example" name="kecamatan" id="kecamatan">
        @if (isset($toko->kecamatan))
            <option selected>{{ $toko->kecamatan }}</option>
            @else
            <option selected>Kecamatan</option>
            @endif
        </select>
        </div>

        <label class="form-label text-danger mt-4">Note : Metode Pembayaran Bisa Pilih Salah Satu Tranfer Bank Atau Uang Digital (Tapi Wajib Ada Metode Pembayaran)</label>

        <div class="mb-3">
            <label for="bank" class="form-label">bank</label>
            <input type="text" placeholder="Contoh : BRI" class="form-control @error ('bank') is-invalid @enderror" id="bank" name="bank" value="{{ $toko->bank }}">
            @error('bank')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="no_rekening" class="form-label">No Rekening</label>
            <input type="text" class="form-control @error ('no_rekening') is-invalid @enderror" id="no_rekening" name="no_rekening" value="{{ $toko->no_rekening }}">
            @error('no_rekening')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="uang_digital" class="form-label">Uang Digital</label>
            <input type="text" placeholder="Contoh : Shopee" class="form-control @error ('uang_digital') is-invalid @enderror" id="uang_digital" name="uang_digital" value="{{ $toko->uang_digital }}">
            @error('uang_digital')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="no_digital" class="form-label">No Uang Digital</label>
            <input type="text" class="form-control @error ('no_digital') is-invalid @enderror" id="no_digital" name="no_digital" value="{{ $toko->no_digital }}">
            @error('no_digital')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="whatsapp" class="form-label">Whatsapp</label>
            <input type="text" class="form-control @error ('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ $toko->whatsapp }}">
            @error('whatsapp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        

        <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</div>

<script>

function gambarLogo()
{
   const image = document.querySelector('#logo')
  const preview = document.querySelector('.tampil')
  const gambarBayar = document.querySelector('.gambar')
  const label = document.querySelector('.label')

  preview.style.display = 'block';
  gambarBayar.style.display = 'block';
  label.style.display = 'none';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent){
    preview.src = oFREvent.target.result;
  }
}

function gambarMLogo()
{
   const image = document.querySelector('#mlogo')
  const preview = document.querySelector('.mtampil')
  const gambarTitle = document.querySelector('.mgambar')
  const mlabel = document.querySelector('.mlabel')

  preview.style.display = 'block';
  gambarTitle.style.display = 'block';
  mlabel.style.display = 'none';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent){
    preview.src = oFREvent.target.result;
  }
}
</script>




<script language="javascript" type="text/javascript">  
var mList = {
	"Kota Tegal" : ['margadana', 'tegal barat', 'tegal selatan', 'tegal timur'],
	"Kab Tegal" :  ['margasari', 'bumijawa', 'bojong', 'balapulang', 'pagerbarang',
            'lebaksiu', 'jatinegara', 'kedungbanteng', 'pangkah', 'slawi', 'dukuhwaru', 'adiwerna',
            'dukuhturi', 'talang', 'tarub', 'kramat', 'suradadi', 'warureja',],
};

el_parent = document.getElementById("domisilin");
el_child = document.getElementById("kecamatan");

for (key in mList) {
    el_parent.innerHTML = el_parent.innerHTML + '<option>'+ key +'</option>';
}

el_parent.addEventListener('change', function populate_child(e){
	el_child.innerHTML = '';
	itm = e.target.value;
	if(itm in mList){
			for (i = 0; i < mList[itm].length; i++) {
				el_child.innerHTML = el_child.innerHTML + '<option>'+ mList[itm][i] +'</option>';
			}
	}
});

</script>
@endsection