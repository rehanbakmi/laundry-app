@extends('layouts.app')

@section('title', 'Data Layanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Layanan</h3>
        <a href="{{ route('layanan.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layanans as $layanan)
                        <tr>
                            <td>{{ $layanan->id_layanan }}</td>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</td>
                            <td>{{ $layanan->satuan }}</td>
                            <td class="text-end">
                                <a href="{{ route('layanan.show', $layanan) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                <a href="{{ route('layanan.edit', $layanan) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('layanan.destroy', $layanan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data layanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $layanans->links() }}
    </div>
@endsection
