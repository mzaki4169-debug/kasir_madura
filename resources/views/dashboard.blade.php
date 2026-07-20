@extends('layouts.app')

@section('content')

<div class="mb-4">

    <h2>Dashboard</h2>

    <div class="alert alert-primary mt-3">

        <h5>
            Selamat Datang,
            <b>{{ auth()->user()->name }}</b>
        </h5>

        Hari ini :
        {{ now()->translatedFormat('l, d F Y') }}

    </div>

</div>

<!-- Statistik -->

<div class="row">

    <div class="col-md-3 mb-3">

        <div class="card text-bg-primary shadow">

            <div class="card-body text-center">

                <h5>Total Barang</h5>

                <h2>{{ $totalBarang }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-bg-success shadow">

            <div class="card-body text-center">

                <h5>Total Kategori</h5>

                <h2>{{ $totalKategori }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-bg-warning shadow">

            <div class="card-body text-center">

                <h5>Total Transaksi</h5>

                <h2>{{ $totalTransaksi }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-bg-danger shadow">

            <div class="card-body text-center">

                <h5>Penjualan Hari Ini</h5>

                <h5>

                    Rp {{ number_format($penjualanHariIni,0,',','.') }}

                </h5>

            </div>

        </div>

    </div>

</div>

<!-- Profit -->

<div class="card border-success shadow mb-4">

    <div class="card-header">

        Profit Hari Ini

    </div>

    <div class="card-body">

        <h3 class="text-success">

            Rp {{ number_format($profitHariIni,0,',','.') }}

        </h3>

    </div>

</div>

<!-- Grafik -->

<div class="row mb-4">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                Grafik Penjualan

            </div>

            <div class="card-body">

                <canvas id="chartPenjualan"></canvas>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                Grafik Profit

            </div>

            <div class="card-body">

                <canvas id="chartProfit"></canvas>

            </div>

        </div>

    </div>

</div>

<!-- Barang Terlaris -->

<div class="row mb-4">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-warning">

                🏆 Top 5 Barang Terlaris

            </div>

            <div class="card-body">

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>Barang</th>

                            <th>Terjual</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($barangTerlaris as $item)

                        <tr>

                            <td>{{ $item->barang->nama_barang }}</td>

                            <td>

                                <span class="badge bg-success">

                                    {{ $item->total_terjual }}

                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="2" class="text-center">

                                Belum ada data

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- Transaksi -->

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-info text-white">

                Transaksi Terbaru

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Kode</th>

                            <th>Total</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($transaksiTerbaru as $trx)

                        <tr>

                            <td>{{ $trx->kode_transaksi }}</td>

                            <td>

                                Rp {{ number_format($trx->total,0,',','.') }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="2" class="text-center">

                                Belum ada transaksi

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- Stok Menipis -->

<div class="card shadow">

    <div class="card-header bg-danger text-white">

        Barang Stok Menipis

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Kode</th>

                    <th>Nama</th>

                    <th>Stok</th>

                </tr>

            </thead>

            <tbody>

                @forelse($stokMenipis as $item)

                <tr>

                    <td>{{ $item->kode_barang }}</td>

                    <td>{{ $item->nama_barang }}</td>

                    <td>

                        <div class="progress">

                            <div
                                class="progress-bar bg-danger"
                                style="width: {{ min($item->stok*20,100) }}%;">

                                {{ $item->stok }}

                            </div>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="text-center">

                        Tidak ada stok menipis

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="col-md-3 mb-3">

<div class="card text-bg-dark shadow">

<div class="card-body text-center">

<h5>Total Nilai Stok</h5>

<h5>

Rp {{ number_format($totalNilaiStok,0,',','.') }}

</h5>

</div>

</div>

</div>

</div>

<script>

const tanggal = [
@foreach($grafik as $g)
"{{ date('d/m',strtotime($g->tanggal)) }}",
@endforeach
];

const total = [
@foreach($grafik as $g)
{{ $g->total }},
@endforeach
];

new Chart(document.getElementById('chartPenjualan'),{
type:'line',
data:{
labels:tanggal,
datasets:[{
label:'Penjualan',
data:total,
borderWidth:3,
fill:false,
tension:0.3
}]
}
});

const bulan = [
@foreach($grafikProfit as $g)
"{{ $g->bulan }}",
@endforeach
];

const profit = [
@foreach($grafikProfit as $g)
{{ $g->profit }},
@endforeach
];

new Chart(document.getElementById('chartProfit'),{
type:'bar',
data:{
labels:bulan,
datasets:[{
label:'Profit',
data:profit,
borderWidth:2
}]
}
});

</script>

@endsection