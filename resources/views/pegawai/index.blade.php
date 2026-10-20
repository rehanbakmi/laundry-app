@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Pegawai</h3>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">+ Tambah Pegawai</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No. Telp</th>
                        <th>Jabatan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawais as $pegawai)
                        <tr>
                            <td>{{ $pegawai->id_pegawai }}</td>
                            <td>{{ $pegawai->nama }}</td>
                            <td>{{ $pegawai->no_telp }}</td>
                            <td>{{ $pegawai->jabatan }}</td>
                            <td class="text-end">
                                <a href="{{ route('pegawai.show', $pegawai) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                <a href="{{ route('pegawai.edit', $pegawai) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('pegawai.destroy', $pegawai) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data pegawai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $pegawais->links() }}
    </div>
@endsection
