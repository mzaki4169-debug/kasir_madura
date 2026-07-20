@extends('layouts.app')

@section('content')

<h2 class="mb-3">Tambah Kategori</h2>

<div class="card">
    <div class="card-body">

        <form action="{{ route('kategori.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="form-control"
                    required>

                @error('nama_kategori')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <button class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('kategori.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection