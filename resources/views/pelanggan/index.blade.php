@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Pelanggan</h3>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">+ Tambah Pelanggan</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $pelanggan)
                        <tr>
                            <td>{{ $pelanggan->id_pelanggan }}</td>
                            <td>{{ $pelanggan->nama }}</td>
                            <td>{{ $pelanggan->no_telp }}</td>
                            <td>{{ $pelanggan->alamat }}</td>
                            <td class="text-end">
                                <a href="{{ route('pelanggan.show', $pelanggan) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data pelanggan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $pelanggans->links() }}
    </div>
@endsection
