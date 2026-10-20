<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'pegawai'])
            ->latest()
            ->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $pegawais   = Pegawai::all();
        $layanans   = Layanan::all();

        return view('transaksi.create', compact('pelanggans', 'pegawais', 'layanans'));
    }

    /**
     * Simpan transaksi sekaligus beberapa detail layanan (many to many).
     * Contoh payload dari form:
     * layanan_id   = [1, 3]
     * qty_berat    = [3, 1]   -> 3kg cuci kering, 1 set setrika selimut
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id'      => 'required|exists:pelanggans,id_pelanggan',
            'pegawai_id'        => 'required|exists:pegawais,id_pegawai',
            'tanggal_masuk'     => 'required|date',
            'tanggal_selesai'   => 'nullable|date|after_or_equal:tanggal_masuk',
            'status'            => 'required|in:diproses,selesai,diambil',
            'layanan_id'        => 'required|array|min:1',
            'layanan_id.*'      => 'required|exists:layanans,id_layanan',
            'qty_berat'         => 'required|array|min:1',
            'qty_berat.*'       => 'required|numeric|min:0.1',
        ]);

        DB::transaction(function () use ($validated) {
            $transaksi = Transaksi::create([
                'pelanggan_id'    => $validated['pelanggan_id'],
                'pegawai_id'      => $validated['pegawai_id'],
                'tanggal_masuk'   => $validated['tanggal_masuk'],
                'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
                'status'          => $validated['status'],
            ]);

            foreach ($validated['layanan_id'] as $i => $layananId) {
                $layanan = Layanan::find($layananId);
                $qty     = $validated['qty_berat'][$i];

                $transaksi->detailTransaksis()->create([
                    'layanan_id' => $layananId,
                    'qty_berat'  => $qty,
                    'subtotal'   => $layanan->harga * $qty,
                ]);
            }
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'pegawai', 'detailTransaksis.layanan', 'pembayarans']);

        return view('transaksi.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $transaksi->load('detailTransaksis');
        $pelanggans = Pelanggan::all();
        $pegawais   = Pegawai::all();
        $layanans   = Layanan::all();

        return view('transaksi.edit', compact('transaksi', 'pelanggans', 'pegawais', 'layanans'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'pelanggan_id'    => 'required|exists:pelanggans,id_pelanggan',
            'pegawai_id'      => 'required|exists:pegawais,id_pegawai',
            'tanggal_masuk'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_masuk',
            'status'          => 'required|in:diproses,selesai,diambil',
            'layanan_id'      => 'required|array|min:1',
            'layanan_id.*'    => 'required|exists:layanans,id_layanan',
            'qty_berat'       => 'required|array|min:1',
            'qty_berat.*'     => 'required|numeric|min:0.1',
        ]);

        DB::transaction(function () use ($validated, $transaksi) {
            $transaksi->update([
                'pelanggan_id'    => $validated['pelanggan_id'],
                'pegawai_id'      => $validated['pegawai_id'],
                'tanggal_masuk'   => $validated['tanggal_masuk'],
                'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
                'status'          => $validated['status'],
            ]);

            // Hapus detail lama lalu simpan ulang (cara paling sederhana untuk update M:N + atribut pivot)
            $transaksi->detailTransaksis()->delete();

            foreach ($validated['layanan_id'] as $i => $layananId) {
                $layanan = Layanan::find($layananId);
                $qty     = $validated['qty_berat'][$i];

                $transaksi->detailTransaksis()->create([
                    'layanan_id' => $layananId,
                    'qty_berat'  => $qty,
                    'subtotal'   => $layanan->harga * $qty,
                ]);
            }
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete(); // detail_transaksis & pembayarans ikut terhapus (onDelete cascade)

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
