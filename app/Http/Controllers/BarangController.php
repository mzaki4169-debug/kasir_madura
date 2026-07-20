<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $query = Barang::with('kategori');

    if ($request->search) {

        $query->where(
            'nama_barang',
            'like',
            '%' . $request->search . '%'
        );

    }

    $barang = $query
        ->orderBy('kode_barang')
        ->get();

    return view('barang.index', compact('barang'));
}

    public function create()
{
    $kategori = Kategori::all();

    $lastBarang = Barang::orderBy('id', 'desc')->first();

    if ($lastBarang) {

        $angka = (int) substr($lastBarang->kode_barang, 3) + 1;

    } else {

        $angka = 1;

    }

    $kodeBarang = str_pad($angka, 3, '0', STR_PAD_LEFT);

    return view('barang.create', compact(
        'kategori',
        'kodeBarang'
    ));
}

    public function store(Request $request)
{
   $request->validate([
    'kategori_id' => 'required',
    'kode_barang' => 'required|unique:barang,kode_barang',
    'nama_barang' => 'required',
    'harga_beli' => 'required',
    'harga_jual' => 'required',
    'stok' => $request->stok,

'satuan' => $request->satuan,
]);

    Barang::create([

        'kategori_id' => $request->kategori_id,

        'kode_barang' => $request->kode_barang,

        'nama_barang' => $request->nama_barang,

        'harga_beli' => str_replace('.', '', $request->harga_beli),

        'harga_jual' => str_replace('.', '', $request->harga_jual),

        'stok' => $request->stok,

        'satuan' => $request->satuan,

    ]);

    return redirect()
        ->route('barang.index')
        ->with('success', 'Barang berhasil ditambahkan');
}

    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();

        return view('barang.edit', compact(
            'barang',
            'kategori'
        ));
    }

    public function update(Request $request, Barang $barang)
{
    $request->validate([
        'kategori_id' => 'required',
        'kode_barang' => 'required|unique:barang,kode_barang,' . $barang->id,
        'nama_barang' => 'required',
        'harga_beli' => 'required',
        'harga_jual' => 'required',
        'stok' => 'required|numeric',
        'satuan' => 'required'
    ]);

    $barang->update([

        'kategori_id' => $request->kategori_id,

        'kode_barang' => $request->kode_barang,

        'nama_barang' => $request->nama_barang,

        'harga_beli' => str_replace('.', '', $request->harga_beli),

        'harga_jual' => str_replace('.', '', $request->harga_jual),

        'stok' => $request->stok,

        'satuan' => $request->satuan,

    ]);

    return redirect()
        ->route('barang.index')
        ->with('success', 'Barang berhasil diupdate');
}

    public function destroy(Barang $barang)
{
    $barang->delete();

    return redirect()
        ->route('barang.index')
        ->with('success', 'Barang berhasil dihapus');
}
}