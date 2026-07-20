@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h2>
        <i class="bi bi-clock-history"></i>
        Riwayat Transaksi
    </h2>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow">

<div class="card-body">

<form method="GET" class="mb-3">

<div class="row">

<div class="col-md-4">

<input
type="text"
name="search"
class="form-control"
placeholder="Cari kode transaksi..."
value="{{ request('search') }}">

</div>

<div class="col-md-3">

<input
type="date"
name="tanggal"
class="form-control"
value="{{ request('tanggal') }}">

</div>

<div class="col-md-2">

<button class="btn btn-primary">

Cari

</button>

</div>

</div>

</form>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>Kode</th>

<th>Tanggal</th>

<th>Total</th>

<th>Bayar</th>

<th>Kembalian</th>

<th width="180">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($transaksi as $item)

<tr>

<td>

{{ $item->kode_transaksi }}

</td>

<td>

{{ date('d-m-Y H:i',strtotime($item->tanggal)) }}

</td>

<td>

Rp {{ number_format($item->total,0,',','.') }}

</td>

<td>

Rp {{ number_format($item->bayar,0,',','.') }}

</td>

<td>

Rp {{ number_format($item->kembalian,0,',','.') }}

</td>

<td>

<a
href="{{ route('transaksi.show',$item->id) }}"
class="btn btn-info btn-sm">

Detail

</a>

<a
href="{{ route('transaksi.cetak',$item->id) }}"
class="btn btn-success btn-sm">

Cetak

</a>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center">

Belum ada transaksi

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $transaksi->links() }}

</div>

</div>

@endsection