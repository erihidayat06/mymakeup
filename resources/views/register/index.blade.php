@extends('login.layouts.main')

@section('container')


<div class="col-lg-5">
<main class="form-signin w-100 bg-light shadow" id="register">
  <form action="/register" method="post">
    @csrf
    <h1 class="h3 mb-3 fw-normal">Form Daftar</h1>

    <div class="form-floating mt-2">
      <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" value="{{ old('name') }}" placeholder="name" autofocus>
      <label for="name">Name</label>
      @error('name')
          <div class="invalid-feedback">
               {{ $message }}
          </div>
      @enderror
    </div>
    <div class="form-floating mt-2">
      <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}"  placeholder="username">
      <label for="username">Username</label>
      @error('username')
          <div class="invalid-feedback">
               {{ $message }}
          </div>
      @enderror
    </div>
    <div class="form-floating mt-2">
      <input type="email" class="form-control @error('email') is-invalid @enderror"  id="floatingInput" name="email" value="{{ old('email') }}" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
        @error('email')
          <div class="invalid-feedback">
               {{ $message }}
          </div>
        @enderror
    </div>
    <div class="form-floating mt-2">
      <input type="password" class="form-control @error('password') is-invalid @enderror"  id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
      @error('password')
          <div class="invalid-feedback">
               {{ $message }}
          </div>
      @enderror
    </div>

    <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Daftar</button>
    <p>Sudah Daftar? <a href="/login">Login Sekarang</a> </p>
  </form>
</main>
</div>


@endsection
