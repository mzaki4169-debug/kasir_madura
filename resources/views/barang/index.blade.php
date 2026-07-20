@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h2>Data Barang</h2>

    <a href="{{ route('barang.create') }}"
       class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>
        Tambah Barang

    </a>

</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-body">

        <form method="GET" class="mb-3">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari barang..."
                    value="{{ request('search') }}">

                <button class="btn btn-primary">
                    Cari
                </button>

            </div>

        </form>

        <table class="table table-bordered table-striped">

           <thead class="table-dark text-center">

<tr>

<th>Kode</th>
<th>Nama Barang</th>
<th>Kategori</th>
<th>Harga Jual</th>
<th>Stok</th>
<th>Satuan</th>
<th>Aksi</th>

</tr>

</thead>
            <tbody>

                @forelse($barang as $item)

<tr>

    <td>{{ $item->kode_barang }}</td>

    <td>
        <strong>{{ $item->nama_barang }}</strong>
    </td>

    <td>{{ $item->kategori->nama_kategori }}</td>

    <td>
        Rp {{ number_format($item->harga_jual,0,',','.') }}
    </td>

    <td class="text-center">

        @if($item->stok <= 10)

            <span class="badge bg-danger">
                {{ $item->stok }}
            </span>

        @elseif($item->stok <= 30)

            <span class="badge bg-warning text-dark">
                {{ $item->stok }}
            </span>

        @else

            <span class="badge bg-success">
                {{ $item->stok }}
            </span>

        @endif

    </td>

    <td class="text-center">
        {{ $item->satuan }}
    </td>

    <td class="text-center">

        <a href="{{ route('barang.edit', $item->id) }}"
           class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i> Edit
        </a>

        <form action="{{ route('barang.destroy', $item->id) }}"
              method="POST"
              class="d-inline">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin ingin menghapus?')">

                <i class="bi bi-trash"></i> Hapus

            </button>

        </form>

    </td>

</tr>

@empty

<tr>
    <td colspan="7" class="text-center">
        Belum ada data barang
    </td>
</tr>

@endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection