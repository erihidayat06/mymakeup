{{-- Awal Navbar --}}
<nav class="navbar fixed-top navbar-expand-lg navbar-dark shadow-sm" id="navbar">
  <div class="container">
    <a class="navbar-brand" href="/">My Makeup</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse float-end" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="/pilihan" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li class="border-bottom"><a class="dropdown-item" href="/pilihan">All</a></li>
            @foreach($categories as $category)
            <li><a class="dropdown-category dropdown-item" href="/pilihan?category={{ $category->slug }}">{{ $category->nama }}</a></li>
            @endforeach
            </li>
          </ul>

          <li class="nav-item">
            <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#about">
            Tenang Kami
          </a>
          </li>
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }} <i class="bi bi-person-circle position-relative">
            </i>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item position-relative" href="/pesanan">
              <i class="bi bi-cart2"></i>
                Pesanan 
              @if (count($notif)<=0)
                 <span class=""> 
                <span class="visually-hidden">unread messages</span></span></a></li>
              @else
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> 
                {{ count($notif) }}
                <span class="visually-hidden">unread messages</span></span></a></li>
              @endif
              
            @can('admin')
            <li><a class="dropdown-item" href="/dashboard">
              <i class="bi bi-database-check"></i>
              Dashboard</a></li>
            @else
            <li><a class="dropdown-item" href="/buat-toko">
              <i class="bi bi-pencil-square"></i>
              Buat Toko</a></li>
            @endcan
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout">
  
              <button type="submit" class="dropdown-item">
                Logout
                <i class="bi bi-box-arrow-right"></i>
              </button>
              </form>
            </li>
          </ul>
        </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
      </li>     
      @endauth
    </ul>    
    </div>
  </div>
</nav>
{{-- Akhir navbar --}}







<!-- Modal  Lokasi-->
<div class="modal fade" id="about" aria-hidden="true" aria-labelledby="aboutLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="lokasiLabel">Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div style="width:400px" class="modal-body">
       <h3 class="fw-bold">ABOUT</h3>
        <p>           
              Website <b>My Makeup</b>  Merupakan Website
              yang bisa di gunakan oleh para Make Up Artist (MUA)        
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-outline-primary" data-bs-target="#about2" data-bs-toggle="modal">Kirim Pesan <i class="bi bi-chat-right-dots"></i></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="about2" aria-hidden="true" aria-labelledby="aboutLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="aboutLabel2">Form Pesan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
  <strong>Terima Kasih!</strong> Pesan Anda telah kami terima
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        <form name="pesan-benz-makeup" >
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" id="nama" autocomplete="off"> 
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> 
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label">Pesan</label>
          <textarea name="pesan" class="form-control" id="pesan" cols="10" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-sm btn-outline-primary btn-kirim">Kirim</button>
        <button class="btn btn-sm btn-outline-primary btn-loading d-none" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Loading...
        </button>
      </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-primary" data-bs-target="#about" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
<a class="btn btn-sm btn-primary" data-bs-toggle="modal" href="#about" role="button">Open first modal</a>


