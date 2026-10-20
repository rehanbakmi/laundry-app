<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('transaksi.pelanggan')->latest()->paginate(10);
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $transaksis = Transaksi::with('pelanggan')->get();
        return view('pembayaran.create', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaksi_id'  => 'required|exists:transaksis,id_transaksi',
            'tanggal_bayar' => 'required|date',
            'metode_bayar'  => 'required|in:tunai,transfer,qris',
            'jumlah_bayar'  => 'required|numeric|min:0',
        ]);

        Pembayaran::create($validated);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('transaksi.pelanggan');
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        $transaksis = Transaksi::with('pelanggan')->get();
        return view('pembayaran.edit', compact('pembayaran', 'transaksis'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'transaksi_id'  => 'required|exists:transaksis,id_transaksi',
            'tanggal_bayar' => 'required|date',
            'metode_bayar'  => 'required|in:tunai,transfer,qris',
            'jumlah_bayar'  => 'required|numeric|min:0',
        ]);

        $pembayaran->update($validated);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
