@extends('layouts.app')

@section('content')

<h2>Edit Barang</h2>

<div class="card">
<div class="card-body">

<form
action="{{ route('barang.update',$barang->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="mb-3">

<label>Kategori</label>

<select
name="kategori_id"
class="form-control">

@foreach($kategori as $k)

<option
value="{{ $k->id }}"
{{ $barang->kategori_id == $k->id ? 'selected' : '' }}>

{{ $k->nama_kategori }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">
<label>Kode Barang</label>

<input
type="text"
name="kode_barang"
class="form-control"
value="{{ old('kode_barang', $barang->kode_barang) }}"
readonly>
</div>

<div class="mb-3">
<label>Nama Barang</label>

<input
type="text"
name="nama_barang"
class="form-control"
value="{{ $barang->nama_barang }}">
</div>

<div class="mb-3">
<label>Harga Beli</label>

<input
type="text"
id="harga_beli"
name="harga_beli"
class="form-control"
value="{{ number_format($barang->harga_beli,0,',','.') }}">
</div>

<div class="mb-3">
<label>Harga Jual</label>

<input
type="text"
id="harga_jual"
name="harga_jual"
class="form-control"
value="{{ number_format($barang->harga_jual,0,',','.') }}">
</div>

<div class="mb-3">
<label>Stok</label>

<input
type="number"
name="stok"
class="form-control"
value="{{ $barang->stok }}">
</div>

<div class="mb-3">
    <label>Satuan</label>

    <input
        type="text"
        name="satuan"
        class="form-control"
        value="{{ old('satuan', $barang->satuan) }}"
        required>
</div>

<div class="mb-3">

    <label>Foto Saat Ini</label>

    <br>

    @if($barang->foto)

        <img
            src="{{ asset('storage/'.$barang->foto) }}"
            width="120"
            class="img-thumbnail mb-2">

    @else

        <p class="text-muted">Belum ada foto</p>

    @endif

</div>

<div class="mb-3">

    <label>Ganti Foto</label>

    <input
        type="file"
        name="foto"
        class="form-control">

</div>

<div class="mb-3">

<label>Foto Barang</label>

@if($barang->foto)

<img
src="{{ asset('storage/'.$barang->foto) }}"
width="120"
class="mb-2 d-block">

@endif

<input
type="file"
name="foto"
class="form-control">

</div>

<button class="btn btn-warning">
Update
</button>

<a href="{{ route('barang.index') }}"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>
</div>

<script>

function formatRupiah(input){

    let angka = input.value.replace(/\D/g,'');

    input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g,".");

}

document.getElementById('harga_beli')
.addEventListener('keyup',function(){

    formatRupiah(this);

});

document.getElementById('harga_jual')
.addEventListener('keyup',function(){

    formatRupiah(this);

});

</script>

@endsection