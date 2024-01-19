@extends('login.layouts.main')

@section('container')

@include('sweetalert::alert')

<div class="col-lg-5 mb-3">
<main id="login" class="form-signin w-100 bg-light shadow">
  <form action="/login" method="post">
      @csrf
        <h1 class="h3 mb-3 fw-normal">Tolong Login</h1>

        <div class="form-floating mt-3" >
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="name@example.com" autofocus>
        <label for="email">Email address</label>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        </div>
        <div class="form-floating mt-3">
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Masuk</button>
    </form>
    <p>Belmum Daftar? <a href="/register">daftar Sekarang</a></p>
</main>
</div>

@endsection
