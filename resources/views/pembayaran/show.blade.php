@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
    <h3 class="mb-3">Detail Pembayaran</h3>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Transaksi</dt>
                <dd class="col-sm-9">#{{ $pembayaran->transaksi_id }} - {{ $pembayaran->transaksi->pelanggan->nama }}</dd>

                <dt class="col-sm-3">Tanggal Bayar</dt>
                <dd class="col-sm-9">{{ $pembayaran->tanggal_bayar }}</dd>

                <dt class="col-sm-3">Metode</dt>
                <dd class="col-sm-9">{{ $pembayaran->metode_bayar }}</dd>

                <dt class="col-sm-3">Jumlah</dt>
                <dd class="col-sm-9">Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</dd>
            </dl>
        </div>
    </div>

    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
