@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    Detail Transaksi
</h2>

<div class="card mb-3">

    <div class="card-body">

        <table class="table table-borderless">

            <tr>
                <th width="200">Kode Transaksi</th>
                <td>{{ $transaksi->kode_transaksi }}</td>
            </tr>

            <tr>
                <th>Tanggal</th>
                <td>{{ date('d-m-Y H:i', strtotime($transaksi->tanggal)) }}</td>
            </tr>

            <tr>
                <th>Total</th>
                <td>
                    <strong>
                        Rp {{ number_format($transaksi->total,0,',','.') }}
                    </strong>
                </td>
            </tr>

            <tr>
                <th>Bayar</th>
                <td>
                    Rp {{ number_format($transaksi->bayar,0,',','.') }}
                </td>
            </tr>

            <tr>
                <th>Kembalian</th>
                <td>
                    Rp {{ number_format($transaksi->kembalian,0,',','.') }}
                </td>
            </tr>

        </table>

    </div>

</div>

<div class="card">

    <div class="card-header bg-primary text-white">

        Daftar Barang

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead class="table-light">

                <tr>

                    <th>No</th>

                    <th>Barang</th>

                    <th>Harga</th>

                    <th>Qty</th>

                    <th>Subtotal</th>

                </tr>

            </thead>

            <tbody>

                @foreach($transaksi->details as $detail)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $detail->barang->nama_barang }}</td>

                    <td>
                        Rp {{ number_format($detail->harga,0,',','.') }}
                    </td>

                    <td>{{ $detail->qty }}</td>

                    <td>
                        Rp {{ number_format($detail->subtotal,0,',','.') }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="mt-3">

    <a href="{{ route('riwayat.index') }}"
       class="btn btn-secondary">

        Kembali

    </a>

    <a href="{{ route('transaksi.cetak',$transaksi->id) }}"
       class="btn btn-success">

        Cetak Struk

    </a>

</div>

@endsection