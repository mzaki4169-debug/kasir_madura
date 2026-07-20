@extends('layouts.app')

@section('content')

<h2 class="mb-3">Edit Kategori</h2>

<div class="card">
    <div class="card-body">

        <form action="{{ route('kategori.update',$kategori->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="form-control"
                    value="{{ $kategori->nama_kategori }}"
                    required>

            </div>

            <button class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('kategori.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection