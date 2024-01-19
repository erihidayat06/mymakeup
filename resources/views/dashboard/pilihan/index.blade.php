@extends('dashboard.layout.main')

@section('container')
<h1>Halaman {{ $judul }}</h1>




{{-- input Pencarian --}}
    <form action="/dashboard/pilihan">
    @csrf
    <div class="input-group mb-3">
      @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
      @endif
      <input type="text" class="form-control" name="cari" placeholder="Cari Makeup..." value="{{ request('cari') }}">
      <button class="btn btn-primary"  type="submit" id="button-addon2">Cari</button>
    </div>
    </form>

    <div class="row row-cols-2">
    <div class="col col-lg-2">
       <a href="/dashboard/pilihan/create" class="btn btn-sm btn-primary" role="button">Tambah Pilihan</a>
    </div>
   <div class="col col-lg-3">
    <div class="dropdown">
    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      @if (request('category'))
          {{ $category }}
      @else
          Category
      @endif
      
    </button>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li><a class="dropdown-item" href="/dashboard/pilihan">All</a></li>
      @foreach ($categories as $category)
        <li><a class="dropdown-item" href="/dashboard/pilihan?category={{ $category->slug }}">{{ $category->nama }}</a></li>
      @endforeach
    </ul>
    </div>
   </div>
    </div>
    



<div class="mt-3 pagination-sm">{{ $pilihans->links() }}</div>

<div class="table-responsive col-lg-10">
  <div class="mb-3 col text-end">
showing {{$pilihans->firstItem()}} to {{$pilihans->lastItem()}} of {{$pilihans->total()}}
</div> 
  <table class="table table-striped text-start table-bordered table-sm">
    <thead>  
      <tr>
        <th scope="col">#</th>
        <th scope="col">Jenis Makeup</th>
        <th scope="col">harga</th>
        <th scope="col">category</th>
        <th scope="col">Option</th>
      </tr>
      </thead>
      <tbody>

      <?php $i=1 ?>
      @foreach ($pilihans as $pilih)
        
      <tr>
        <th scope="row"><?=$i++?></td>
        <td>{{ $pilih->jns_makeup }}</td>
        <td>{{ $pilih->harga }}</td>
        <td>{{ $pilih->category->nama }}</td>
        <td>
          <a href="/dashboard/pilihan/{{ $pilih->slug }}" class="badge bg-success" ><i class="bi bi-eye"></i></a>
          <a href="/dashboard/pilihan/{{ $pilih->slug }}/edit" class="badge bg-warning" ><i class="bi bi-pencil-square"></i></a>

          <form action="/dashboard/pilihan/{{ $pilih->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
          <button type="submit" class="badge bg-danger border-0 " onclick="return confirm('Apa Kamu Yakin')"><i class="bi bi-x-circle"></i></button>
          </form>
        </td>
      </tr>
      
      @endforeach

      @if ($i == 1)
      <tr>
        <td colspan="10" class="text-center">Tidak Ada Data</td>
      </tr>
      @endif
      </tbody>
    </table>
</div>
</div>
      

@endsection