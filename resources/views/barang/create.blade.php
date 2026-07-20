@extends('layouts.app')

@section('content')

<h2>Tambah Barang</h2>

<div class="card">
<div class="card-body">

<form action="{{ route('barang.store') }}"
      method="POST"
      enctype="multipart/form-data">
@csrf

<div class="mb-3">
<label>Kategori</label>

<select name="kategori_id"
        class="form-control">

@foreach($kategori as $k)

<option value="{{ $k->id }}">
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
    value="{{ $kodeBarang }}"
    readonly>
</div>

<div class="mb-3">
<label>Nama Barang</label>

<input
type="text"
name="nama_barang"
class="form-control">
</div>

<div class="mb-3">
    <label>Harga Beli</label>

    <input
        type="text"
        id="harga_beli"
        name="harga_beli"
        class="form-control"
        placeholder="Masukkan Harga Beli"
        required>
</div>

<div class="mb-3">
    <label>Harga Jual</label>

    <input
        type="text"
        id="harga_jual"
        name="harga_jual"
        class="form-control"
        placeholder="Masukkan Harga Jual"
        required>
</div>

<div class="mb-3">
<label>Stok</label>

<input
type="number"
name="stok"
class="form-control">
</div>

<div class="mb-3">
<label>Satuan</label>

<input
type="text"
name="satuan"
class="form-control">
</div>

<button class="btn btn-success">
Simpan
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