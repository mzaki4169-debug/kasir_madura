<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir Warung Madura</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 bg-dark text-white min-vh-100">

            <h4 class="text-center mt-3">
                <i class="bi bi-shop"></i>
                Warung Madura
            </h4>

            <hr>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link text-white">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}"
                       class="nav-link text-white">
                        <i class="bi bi-tags"></i>
                        Kategori
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('barang.index') }}"
                       class="nav-link text-white">
                        <i class="bi bi-box"></i>
                        Barang
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('transaksi.index') }}"
                       class="nav-link text-white">
                        <i class="bi bi-cart"></i>
                        Transaksi
                    </a>
                </li>

                <li class="nav-item">
    <a href="{{ route('laporan.index') }}"
       class="nav-link text-white">

        <i class="bi bi-file-earmark-bar-graph"></i>
        Laporan Penjualan

    </a>
</li>

<li class="nav-item">
    <a href="{{ route('laba.index') }}"
       class="nav-link text-white">

        <i class="bi bi-cash-stack"></i>
        Laporan Laba Rugi

    </a>
</li>

                <li class="nav-item">
                <a href="{{ route('riwayat.index') }}"
                class="nav-link text-white">

                <i class="bi bi-clock-history"></i>
                Riwayat Transaksi

                </a>
            </li>

                <li class="nav-item mt-3">
                    <form action="{{ route('logout') }}"
                          method="POST">

                        @csrf

                        <button class="btn btn-danger w-100">
                            Logout
                        </button>

                    </form>
                </li>

            </ul>

        </div>

        <!-- Content -->
        <div class="col-md-10 p-4">

            @yield('content')

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>