@extends('buatToko.layouts.main')

@section('container')


<div class="col-lg-5">
<main class="form-signin w-100 bg-light shadow" id="register">
  <form action="/buat-toko" method="post" id="formSearch">
    @csrf
    @method('GET')
    <h1 class="h3 mb-3 fw-normal">Form Daftar</h1>

    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <div class="form-floating mt-2">
      <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="nama_toko" value="{{ old('name') }}" placeholder="name" autofocus>
      <label for="name">Name</label>
      @error('name')
          <div class="invalid-feedback">
               {{ $message }}
          </div>
      @enderror
    </div>

    <div class="form-floating mt-2">
      <input type="text" class="form-control @error('no_whatsapp') is-invalid @enderror " id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="no_whatsapp" autofocus>
      <label for="no_whatsapp">No Whatsapp</label>
      @error('no_whatsapp')
          <div class="invalid-feedback">
               {{ $message }}
          </div>
      @enderror
    </div>

    <div class="form-floating mt-2">
        <textarea type="text" class="form-control  @error('username') is-invalid @enderror" id="username" name="alamat"  placeholder="username" cols="30" rows="10">{{ old('username') }}</textarea>
      <label for="username">Alamat</label>
      @error('username')
          <div class="invalid-feedback">
               {{ $message }}
          </div>
      @enderror
    </div>  
    
    <div class="mt-2">
    <select class="form-select" aria-label="Default select example" name="domisilin" id="domisilin">   
      <option selected>Domisilin</option>
    </select>
    </div>

    <div class="mt-2">
    <select class="form-select" aria-label="Default select example" name="kecamatan" id="kecamatan">
      <option selected>Kecamatan</option>
    </select>
    </div>

    <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Daftar</button>
  </form>
</main>
</div>


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
