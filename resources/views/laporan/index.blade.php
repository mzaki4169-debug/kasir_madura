@extends('layouts.app')

@section('content')

<div class="container">

```
<h2 class="mb-4">
    Laporan Penjualan
</h2>

<form method="GET">

    <div class="row">

        <div class="col-md-4">

            <label>Dari Tanggal</label>

            <input
                type="date"
                name="dari"
                value="{{ $dari }}"
                class="form-control">

        </div>

        <div class="col-md-4">

            <label>Sampai Tanggal</label>

            <input
                type="date"
                name="sampai"
                value="{{ $sampai }}"
                class="form-control">

        </div>

        <div class="col-md-4">

            <label>&nbsp;</label>

            <div>

                <button
                    class="btn btn-primary">

                    Filter

                </button>

                <a
                    href="{{ route('laporan.export',['dari'=>$dari,'sampai'=>$sampai]) }}"
                    class="btn btn-success">

                    Export Excel

                </a>

            </div>

        </div>

    </div>

</form>

<hr>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>

    @foreach($laporan as $item)

    <tr>

        <td>{{ $item->kode_transaksi }}</td>

        <td>{{ $item->tanggal }}</td>

        <td>
            Rp {{ number_format($item->total,0,',','.') }}
        </td>

    </tr>

    @endforeach

    </tbody>

</table>

{{ $laporan->links() }}
```

</div>

@endsection