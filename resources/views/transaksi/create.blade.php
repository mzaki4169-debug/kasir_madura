@extends('layouts.app')

@section('content')

<h2 class="mb-4">Tambah Transaksi</h2>

<div class="card">
    <div class="card-body">

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kode Transaksi</label>
                <input type="text"
                       name="kode_transaksi"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('transaksi.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection