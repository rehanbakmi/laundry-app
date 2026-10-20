@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
    <h3 class="mb-3">Tambah Pembayaran</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf
                @include('pembayaran._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
