@extends('layouts.app')

@section('title', 'Detail Layanan')

@section('content')
    <h3 class="mb-3">Detail Layanan</h3>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Nama Layanan</dt>
                <dd class="col-sm-9">{{ $layanan->nama_layanan }}</dd>

                <dt class="col-sm-3">Harga</dt>
                <dd class="col-sm-9">Rp{{ number_format($layanan->harga, 0, ',', '.') }} / {{ $layanan->satuan }}</dd>
            </dl>
        </div>
    </div>

    <a href="{{ route('layanan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
