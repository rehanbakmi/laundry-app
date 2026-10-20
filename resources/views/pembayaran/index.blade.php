@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Pembayaran</h3>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">+ Tambah Pembayaran</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Transaksi</th>
                        <th>Tgl Bayar</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayarans as $bayar)
                        <tr>
                            <td>{{ $bayar->id_pembayaran }}</td>
                            <td>#{{ $bayar->transaksi_id }} - {{ $bayar->transaksi->pelanggan->nama }}</td>
                            <td>{{ $bayar->tanggal_bayar }}</td>
                            <td>{{ $bayar->metode_bayar }}</td>
                            <td>Rp{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                            <td class="text-end">
                                <a href="{{ route('pembayaran.show', $bayar) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                <a href="{{ route('pembayaran.edit', $bayar) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('pembayaran.destroy', $bayar) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $pembayarans->links() }}
    </div>
@endsection
