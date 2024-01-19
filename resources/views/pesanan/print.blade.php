<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <style>
body{
  font-family: arial, sans-serif;
}
table {
  width: 100%;
}

td, th {
  
}

.text-muted{
  color: #636363;
  font-size: 12px;
}

</style>

<h3 style="width: 100%;">Benz Makeup</h3>

<table style="border:none">
  <tr>
    <td style="width: 250px">
      <span  class="text-muted">Nama Pelanggan</span>
      <p>{{ $transaksi->user->name }}</p>
    </td>
    <td>
      <span class="text-muted">No Pesanan</span>
      <p>{{ $transaksi->no_pesanan }}</p>
    </td>
  </tr>
  <tr>
    <td>
      <span class="text-muted">Tanggal pesan</span>
      <p>{{  date('d M Y',strtotime($transaksi->created_at)) }}</p>
    </td>
    <td>
    <span class="text-muted">Alamat</span>
    <p>{{ $transaksi->alamat }}</p>
    </td>
  </tr>
</table>

<table style="  border-collapse: collapse;">
    <tr>
      <td style="width: 250px ; border: 1px solid #dddddd;text-align: left;padding: 8px;">
      <span class="text-muted">Jenis Makeup</span>
      <h4>{{ $transaksi->pilihan->jns_makeup }}</h4>
      <td style="border: 1px solid #dddddd;text-align: left; padding: 8px;">
      <span class="text-muted">Tanggal Acara</span>
      <p>{{ date('d M Y',strtotime($transaksi->tgl_acara)) }}</p>
      </td>
      </tr>
      <tr>
      <td style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>
      <td style="border: 1px solid #dddddd;text-align: left; padding: 8px;">
      <span class="text-muted">Harga</span>
      <p>Rp {{ number_format($transaksi->pilihan->harga, 0 , '')  }}</p> 


      <span class="text-muted">Biaya Layanan</span>
      <p class="mt-1">Rp 0</p>
      <hr>
      <span class="text-muted">Total Bayar</span>
      <p class="mt-1">Rp {{ number_format($transaksi->pilihan->harga, 0 , '') }}</p>
      </td>
    </tr>
      
      

</table>

</body>
</html>