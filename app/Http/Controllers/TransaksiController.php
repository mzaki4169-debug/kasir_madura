<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
   public function index()
{
    $barang = Barang::all();

    return view('transaksi.index', compact('barang'));
}

    public function create()
{
    return view('transaksi.create');
}

public function edit($id)
{
    $transaksi = Transaksi::findOrFail($id);

    return view(
        'transaksi.edit',
        compact('transaksi')
    );
}

public function cetak($id)
{
    $transaksi = Transaksi::with('details.barang')
                    ->findOrFail($id);

    $pdf = Pdf::loadView(
        'riwayat.struk',
        compact('transaksi')
    );

    return $pdf->stream(
        'struk-'.$transaksi->kode_transaksi.'.pdf'
    );
}

public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required|array|min:1',
        'qty' => 'required|array|min:1',
        'harga' => 'required|array|min:1',
        'total' => 'required|numeric',
        'bayar' => 'required|numeric'
    ]);

    if ($request->bayar < $request->total) {
        return back()->with('error', 'Uang pembayaran kurang.');
    }

    DB::beginTransaction();

    try {

        $last = Transaksi::latest()->first();

        $nomor = $last
            ? ((int) substr($last->kode_transaksi, 3)) + 1
            : 1;

        $kode = 'TRX' . str_pad($nomor, 5, '0', STR_PAD_LEFT);

        $transaksi = Transaksi::create([
            'kode_transaksi' => $kode,
            'tanggal' => now(),
            'total' => $request->total,
            'bayar' => $request->bayar,
            'kembalian' => $request->bayar - $request->total,
            'user_id' => auth()->id()
        ]);

        foreach ($request->barang_id as $i => $barangId) {

    $barang = Barang::findOrFail($barangId);

    $qty = (int) $request->qty[$i];

    if ($barang->stok <= 0) {

        throw new \Exception(
            "Stok {$barang->nama_barang} sudah habis."
        );

    }

    if ($qty > $barang->stok) {

        throw new \Exception(
            "Stok {$barang->nama_barang} tidak mencukupi."
        );

    }

    $harga = (int) $request->harga[$i];

    $subtotal = $qty * $harga;

    DetailTransaksi::create([

        'transaksi_id' => $transaksi->id,

        'barang_id' => $barangId,

        'qty' => $qty,

        'harga' => $harga,

        'subtotal' => $subtotal

    ]);

    $barang->decrement('stok', $qty);

}

        DB::commit();

        return redirect()
            ->route('riwayat.index')
            ->with('success', 'Transaksi berhasil disimpan.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with(
            'error',
            $e->getMessage()
        );
    }
}

public function riwayat(Request $request)
{
    $query = Transaksi::query();

    if ($request->search) {

        $query->where(
            'kode_transaksi',
            'like',
            '%' . $request->search . '%'
        );

    }

    if ($request->tanggal) {

        $query->whereDate(
            'tanggal',
            $request->tanggal
        );

    }

    $transaksi = $query
        ->latest()
        ->paginate(10);

    return view(
        'riwayat.index',
        compact('transaksi')
    );
}

public function show($id)
{
    $transaksi = Transaksi::with('details.barang')
                    ->findOrFail($id);

    return view(
        'riwayat.detail',
        compact('transaksi')
    );
}

}