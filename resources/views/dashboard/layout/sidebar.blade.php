<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/profil/') ? 'active' : '' }}" aria-current="page" href="/dashboard/profil/{{ auth()->user()->toko->slug }}/edit">
            <span class="bi bi-building"></span>
            Profil Toko
        </a>
        </li>
         <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Data Produk</span>
       </h6>
    </ul>
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link  {{ Request::is('dashboard/pilihan*') ? 'active' : '' }}" href="/dashboard/pilihan">
            <span data-feather="file" class="align-text-bottom"></span>
            Data Pilihan
        </a>
        </li>
    </ul>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Transaksi</span>
       </h6>
       <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ Request::is('dashboard/transaksi') ? 'active' : '' }}" aria-current="page" href="/dashboard/transaksi?cancel=false">
              <span data-feather="grid" class="align-text-bottom"></span>
              Transaksi <span style="margin-left: 10px" class="badge bg-danger">{{ count(App\Models\Transaksi::filter(request(['cancel', 'acc_pesanan', 'cari', 'selesai']))->get()) }}</span>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link {{ Request::is('dashboard/analis') ? 'active' : '' }}" aria-current="page" href="/dashboard/analis">
              <span data-feather="trending-up" class="align-text-bottom"></span>
                Analisa Transaksi
            </a>
        </li>
       </ul>
    </div>
</nav>
         