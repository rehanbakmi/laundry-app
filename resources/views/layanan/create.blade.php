@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
    <h3 class="mb-3">Tambah Layanan</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('layanan.store') }}" method="POST">
                @csrf
                @include('layanan._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
