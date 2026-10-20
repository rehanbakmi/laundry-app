@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Transaksi</h3>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Pegawai</th>
                        <th>Tgl Masuk</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->id_transaksi }}</td>
                            <td>{{ $transaksi->pelanggan->nama }}</td>
                            <td>{{ $transaksi->pegawai->nama }}</td>
                            <td>{{ $transaksi->tanggal_masuk }}</td>
                            <td>
                                <span class="badge bg-{{ $transaksi->status === 'selesai' ? 'success' : ($transaksi->status === 'diambil' ? 'secondary' : 'warning') }}">
                                    {{ $transaksi->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $transaksis->links() }}
    </div>
@endsection
