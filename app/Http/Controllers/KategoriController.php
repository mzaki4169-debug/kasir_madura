<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        $kategori = Kategori::latest()->get();

        return view('kategori.index', compact('kategori'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100|unique:kategori,nama_kategori'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Form edit kategori
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' =>
                'required|max:100|unique:kategori,nama_kategori,' . $kategori->id
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}