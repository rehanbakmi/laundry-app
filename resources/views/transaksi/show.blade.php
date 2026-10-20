@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <h3 class="mb-3">Detail Transaksi #{{ $transaksi->id_transaksi }}</h3>

    <div class="card mb-4">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Pelanggan</dt>
                <dd class="col-sm-9">{{ $transaksi->pelanggan->nama }}</dd>

                <dt class="col-sm-3">Pegawai</dt>
                <dd class="col-sm-9">{{ $transaksi->pegawai->nama }}</dd>

                <dt class="col-sm-3">Tanggal Masuk</dt>
                <dd class="col-sm-9">{{ $transaksi->tanggal_masuk }}</dd>

                <dt class="col-sm-3">Tanggal Selesai</dt>
                <dd class="col-sm-9">{{ $transaksi->tanggal_selesai ?? '-' }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ $transaksi->status }}</dd>
            </dl>
        </div>
    </div>

    <h5>Detail Layanan</h5>
    <table class="table table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>Layanan</th>
                <th>Qty/Berat</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->detailTransaksis as $detail)
                <tr>
                    <td>{{ $detail->layanan->nama_layanan }}</td>
                    <td>{{ $detail->qty_berat }} {{ $detail->layanan->satuan }}</td>
                    <td>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="fw-bold">
                <td colspan="2" class="text-end">Total</td>
                <td>Rp{{ number_format($transaksi->detailTransaksis->sum('subtotal'), 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <h5 class="mt-4">Riwayat Pembayaran</h5>
    <table class="table table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>Tgl Bayar</th>
                <th>Metode</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi->pembayarans as $bayar)
                <tr>
                    <td>{{ $bayar->tanggal_bayar }}</td>
                    <td>{{ $bayar->metode_bayar }}</td>
                    <td>Rp{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada pembayaran.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
