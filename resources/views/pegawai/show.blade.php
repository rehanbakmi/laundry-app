@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
    <h3 class="mb-3">Detail Pegawai</h3>

    <div class="card mb-4">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $pegawai->nama }}</dd>

                <dt class="col-sm-3">No. Telp</dt>
                <dd class="col-sm-9">{{ $pegawai->no_telp }}</dd>

                <dt class="col-sm-3">Jabatan</dt>
                <dd class="col-sm-9">{{ $pegawai->jabatan }}</dd>
            </dl>
        </div>
    </div>

    <h5>Transaksi yang Ditangani</h5>
    <table class="table table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tgl Masuk</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawai->transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->id_transaksi }}</td>
                    <td>{{ $transaksi->tanggal_masuk }}</td>
                    <td>{{ $transaksi->status }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
