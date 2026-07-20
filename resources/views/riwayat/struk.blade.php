<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<style>

body{

font-family: monospace;

font-size:12px;

}

table{

width:100%;

border-collapse:collapse;

}

th,td{

padding:4px;

}

hr{

border:1px dashed black;

}

.center{

text-align:center;

}

.right{

text-align:right;

}

</style>

</head>

<body>

<div class="center">

<h3>WARUNG MADURA</h3>

Jl. Contoh No.123

<br>

Telp.08123456789

<hr>

</div>

Kode :

{{ $transaksi->kode_transaksi }}

<br>

Tanggal :

{{ date('d-m-Y H:i',strtotime($transaksi->tanggal)) }}

<hr>

<table>

@foreach($transaksi->details as $item)

<tr>

<td>

{{ $item->barang->nama_barang }}

<br>

{{ $item->qty }} x
Rp {{ number_format($item->harga,0,',','.') }}

</td>

<td class="right">

Rp {{ number_format($item->subtotal,0,',','.') }}

</td>

</tr>

@endforeach

</table>

<hr>

<table>

<tr>

<td>Total</td>

<td class="right">

Rp {{ number_format($transaksi->total,0,',','.') }}

</td>

</tr>

<tr>

<td>Bayar</td>

<td class="right">

Rp {{ number_format($transaksi->bayar,0,',','.') }}

</td>

</tr>

<tr>

<td>Kembali</td>

<td class="right">

Rp {{ number_format($transaksi->kembalian,0,',','.') }}

</td>

</tr>

</table>

<hr>

<div class="center">

Terima Kasih

<br>

Selamat Berbelanja

</div>

</body>

</html>