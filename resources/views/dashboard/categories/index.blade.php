@extends('dashboard.layout.main')

@section('container')
<div class="mt-3">
  <a href="/dashboard/category/create" class="btn btn-primary" role="button">Tambahkan Categori</a>
</div>

@include('sweetalert::alert')


<div class="table-responsive col-lg-4 mt-3">
  <table class="table table-striped text-start table-bordered table-sm">
    <thead>  
      <tr>
        <th scope="col">#</th>
        <th scope="col">Categori</th>
        <th scope="col">Gambar</th>
        <th scope="col">Option</th>
      </tr>
      </thead>
      <tbody>

      <?php $i=1 ?>
      @foreach ($categories as $category)
        
      <tr>
        <th scope="row"><?=$i++?></td>
        <td>{{ $category->nama }}</td>
        <td><img class="img-thumbnail" src="{{ asset('storage/' . $category->gambar) }}" width="100" alt=""></td>
        <td>
          <a href="/dashboard/category/{{ $category->slug }}/edit" class="badge bg-warning" ><i class="bi bi-pencil-square"></i></a>

          <form action="/dashboard/category/{{ $category->slug }}" method="post" class="d-inline">
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
