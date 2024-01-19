<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @if (request('category'))
    <title>Category {{ $judul }}</title>
    @elseif(isset($pilihan) && !request('category'))
    <title>Category All</title>
    @elseif(isset($detail))
    <title>{{ $pilih->jns_makeup }}</title>
    @elseif(isset($pesanan))
    <title>Pesanan {{ auth()->user()->name }}</title>
    @else
    <title>My Makeup</title>
    @endif
    

    {{-- Icon Boostrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    
    {{-- Css Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Css Style --}}
    <link rel="stylesheet" href="/css/style.css">

    <!-- Logo title -->
    <link rel="icon" type="img/png" href="img/title.png">

    <style>
        
.btn-main-color {
    --bs-btn-color: #fff;
    --bs-btn-bg: var(--main-color);
    --bs-btn-border-color: var(--main-color);
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #1e144d;
    --bs-btn-hover-border-color: var(--hover-color);
    --bs-btn-focus-shadow-rgb: 49, 132, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: var(--hover-color);
    --bs-btn-active-border-color: #1e144d;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #fff;
    --bs-btn-disabled-bg: var(--main-color);
    --bs-btn-disabled-border-color: var(--main-color);
}
    </style>

</head>
<body style="background-color: var(--body-color);">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


@include('partials.navbar')


@yield('container')

@include('partials.footer')


 <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            $('img').lazyload();
        })
    </script>

    <script>
    const scriptURL = 'https://script.google.com/macros/s/AKfycbwVDWNXPu3Z7YrP0TvlKielGEuBhVXtRlOj-aAdrywnTqX4lN5f1byuLFnP-niwxivdzw/exec'
    const form = document.forms['pesan-benz-makeup']
    const btnKirim = document.querySelector('.btn-kirim')
    const btnLoading = document.querySelector('.btn-loading')
    const myAlert = document.querySelector('.my-alert')

    form.addEventListener('submit', e => {
        e.preventDefault()

        btnLoading.classList.toggle('d-none')
        btnKirim.classList.toggle('d-none')
        fetch(scriptURL, { method: 'POST', body: new FormData(form)})
        .then(response => {

            // btn kirim
            btnLoading.classList.toggle('d-none')
            btnKirim.classList.toggle('d-none')
            // tampilkan alet
            myAlert.classList.toggle('d-none')
            // reset form
            form.reset()
            console.log('Success!', response)})
        .catch(error => console.error('Error!', error.message))
    })

    function previewImage(){
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
    </script>
</body>

   
</html>