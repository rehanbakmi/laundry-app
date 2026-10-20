@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
    <h3 class="mb-3">Tambah Pegawai</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                @include('pegawai._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
