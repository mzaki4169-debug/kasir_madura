@extends('layouts.app')

@section('content')

<h2 class="mb-4">Edit Transaksi</h2>

<div class="card">
    <div class="card-body">

        <form action="{{ route('transaksi.update', $transaksi->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kode Transaksi</label>
                <input type="text"
                       name="kode_transaksi"
                       class="form-control"
                       value="{{ $transaksi->kode_transaksi }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="{{ $transaksi->tanggal }}"
                       required>
            </div>

            <button type="submit" class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('transaksi.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection