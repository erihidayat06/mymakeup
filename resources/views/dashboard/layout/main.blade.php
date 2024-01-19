<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Halaman Admin</title>
    
    

    {{-- Bootstrap care CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Logo title -->
    <link rel="icon" type="img/png" href="img/title.png">
    
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <!-- Style style-->
    <link href="/css/logo.css" rel="stylesheet">

    {{-- Icon Halaman --}}
    <link rel="icon" type="img/png" href="https://s3-alpha-sig.figma.com/img/3865/9eea/6d33d9ec618995c486b796d4668fd8a5?Expires=1669593600&Signature=G0FcSzGMg9c6LEyVqKCpt44ngcxBCUqj66UKe~82tCvVp-e3h8gPcfHIgdQeLZjN9c7yo0wVjVu9qiLuqW1j2UMXvKyNZde10kKdWZQRnWs58L8Ace-NTuhm~fRdbbljSpBBsfqM4lqFnYzDQwdUQiFO3tIisCKhqYXehYKPOcEBLKyQ430-eAYSMThULppa421IsvofRo0gmTehL3XVC2opU-X8QKU1bTxSY11lyWla2ExvGki5tudwseqyC6iQJZFzbSM3TgXVkz9mvhi7NySrTExUUBHczhYRW7R3pxldOG7Lske51mRH3EyxhakiPY3dkPiAYXUPy9ms2IbHsQ__&Key-Pair-Id=APKAINTVSUGEWH5XD5UA">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    {{-- Trix Editor --}}
      <link rel="stylesheet" type="text/css" href="/css/trix.css">
  <script type="text/javascript" src="/js/trix.js"></script>

  <style>
    trix-toolbar [data-trix-button-group="file-tools"]{
      display: none;
    }
  </style>
  </head>
  <body>
    
@include('dashboard.layout.header')

<div class="container-fluid">
  <div class="row">
@include('dashboard.layout.sidebar')
@include('sweetalert::alert')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @yield('container')
    </main>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      
      <script src="/js/dashboard.js"></script>

    <script>
    const jns_makeup = document.querySelector('#jns_makeup');
    const slug = document.querySelector('#slug');

    jns_makeup.addEventListener('keyup', function(){
        let preslug = jns_makeup.value;
        preslug = preslug.replace(/ /g,"-");
        slug.value = preslug.toLowerCase();
    })

    document.addEventListener('trix-file-accept', function(e){
        e.preveDefault();
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
