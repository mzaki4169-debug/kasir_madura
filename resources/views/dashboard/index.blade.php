@extends('layouts.app')

@section('content')
<div class="container-fluid pt-3 px-4">
    
    <h2 class="mb-4">Dashboard</h2>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-bg-primary shadow">
                <div class="card-body">
                    <h6>Total Barang</h6>
                    <h2>{{ $totalBarang }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success shadow">
                <div class="card-body">
                    <h6>Total Kategori</h6>
                    <h2>{{ $totalKategori }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning shadow text-dark">
                <div class="card-body">
                    <h6>Total Transaksi</h6>
                    <h2>{{ $totalTransaksi }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-danger shadow">
                <div class="card-body">
                    <h6>Penjualan Hari Ini</h6>
                    <h5>Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 shadow">
        <div class="card-header">
            Grafik Penjualan
        </div>
        <div class="card-body">
            <canvas id="salesChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <div class="card mt-4 shadow">
        <div class="card-header bg-warning text-dark">
            Stok Menipis
        </div>
        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokMenipis as $item)
                    <tr>
                        <td>{{ $item->nama_barang }}</td>
                        <td>
                            <span class="badge bg-danger">
                                {{ $item->stok }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted py-3">
                            Tidak ada stok menipis
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div> <script>
const ctx = document.getElementById('salesChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        datasets: [{
            label: 'Penjualan',
            data: [0, 0, 0, 0, 0, 0, 0],
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endsection