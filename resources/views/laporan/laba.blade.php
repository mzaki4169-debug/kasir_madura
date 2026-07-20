@extends('layouts.app')

@section('content')

<div class="container">

```
<h2 class="mb-4">
    Laporan Laba Rugi
</h2>

<div class="alert alert-success">

    Total Laba :

    <strong>

        Rp {{ number_format($totalLaba,0,',','.') }}

    </strong>

</div>

<table class="table table-bordered">

    <thead>

    <tr>
        <th>Barang</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Qty</th>
        <th>Laba</th>
    </tr>

    </thead>

    <tbody>

    @foreach($detail as $item)

    <tr>

        <td>
            {{ $item->barang->nama_barang }}
        </td>

        <td>
            Rp {{ number_format($item->barang->harga_beli,0,',','.') }}
        </td>

        <td>
            Rp {{ number_format($item->harga,0,',','.') }}
        </td>

        <td>
            {{ $item->qty }}
        </td>

        <td>
            Rp {{ number_format($item->laba,0,',','.') }}
        </td>

    </tr>

    @endforeach

    </tbody>

</table>
```

</div>

@endsection
