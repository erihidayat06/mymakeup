@extends('dashboard.layout.main')

@section('container')

<div class="container">
    <h1 class="mt-3 mb-3">Halaman Analisa</h1>


<!-- Project Card Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Analisa transaksi : {{ date('l, d M Y -') }} <span id="jam"></span></h6>
    </div>
    <div class="card-body">

        <h4 class=" font-weight-bold">Total Transaksi : <span
                class="float-right">{{ count($allTransaksi) }}</span></h4>
        <hr>

        {{-- Analisa Pesanan --}}

        @if (count($allTransaksi) > 0)
           <?php $p = count($pesanan)/count($allTransaksi)*1*100?> 
        
        <h4 class="small font-weight-bold">Pesanan <span
                class="float-right">{{ round($p) }}%</span></h4>
        <div class="progress mb-4">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{ round($p) }}%"
                aria-valuenow="{{ round($p) }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        @else
        <h4 class="small font-weight-bold">Pesanan <span
                class="float-right">0%</span></h4>
        <div class="progress mb-4">
            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        @endif
        {{-- Analisa Cancel --}}

        @if (count($allTransaksi) > 0)
        <?php $c = count($cancel)/count($allTransaksi)*1*100?>

        <h4 class="small font-weight-bold">Cencel <span
                class="float-right">{{ round($c) }}%</span></h4>
        <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ round($c) }}%"
                aria-valuenow="{{ round($c) }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        @else
        <h4 class="small font-weight-bold">Cencel <span
                class="float-right">0%</span></h4>
        <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 0%"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        @endif
    </div>
</div>

<div class="row row-cols-1 row-cols-lg-2">
<!-- Area Chart -->
<div class="col col-lg-6">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Analis Pesanan Perbulan</h6>
        </div>
        
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <h4 class=" font-weight-bold">Total Transaksi : <span
                class="float-right">{{ array_sum($bulan) }}</span></h4>
                <hr>
                <canvas id="myAreaChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Area Chart -->
<div class="col col-lg-6">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Analis Pertahun {{ date('Y')-5 }} - {{ date('Y') }}</h6>
        </div>
        
        <!-- Card Body -->
        <div class="card-body">
            <div style="padding-bottom: 16px" class="chart-area">
                <h4 class=" font-weight-bold">Total Transaksi : <span
                class="float-right">{{ count($allTransaksi) }}</span></h4>
                <hr>
                <div class="text-center"
                id="chart-tahun">
                </div>
            </div>
        </div>
    </div>
</div>
</div>


</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
// Analisa Perbulan
var xValues = ["januari","februari","maret","april","mei","juni","juli","agustus","september","oktober","november","desember"];
var yValues = {!! json_encode($bulan) !!};
var barColors = ["blue","blue","blue","blue","blue","blue","blue","blue","blue","blue","blue","blue"];

new Chart("myAreaChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Analisah Pesanan tahun " + new Date().getFullYear()
    }
  }
});

// analisa pertahun
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable(
  {!! json_encode($tahun) !!}
);

var tahun = new Date().getFullYear()-5
var options = {
  title:'Data Analis dari ' + tahun + " - " + new Date().getFullYear()
};

var chart = new google.visualization.PieChart(document.getElementById('chart-tahun'));
  chart.draw(data, options);
}
</script>

<script type="text/javascript">
// jam
    window.onload = function() { jam(); }
   
    function jam() {
     var e = document.getElementById('jam'),
     d = new Date(), h, m, s;
     h = d.getHours();
     m = set(d.getMinutes());
     s = set(d.getSeconds());
   
     e.innerHTML = h +':'+ m +':'+ s;
   
     setTimeout('jam()', 1000);
    }
   
    function set(e) {
     e = e < 10 ? '0'+ e : e;
     return e;
    }
</script>

 
@endsection
