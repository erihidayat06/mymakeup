<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman </title>

    {{-- Css Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Style Css --}}
    <link rel="stylesheet" href="/css/style.css">

     <!-- Logo title -->
    <link rel="icon" type="img/png" href="img/logo.png">
    
</head>
<body style="background-color: var(--main-color)">

    @include('login.partials.navbar')

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
    <div style="margin-top: 100px" class="gambar-login d-flex justify-content-center">
    <img width="300px" height="300px" src="/img/logo.png" alt="">
    </div>
    @yield('container')
    </div>
</div>

</body>
    {{-- JS Boostrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>