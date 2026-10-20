@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <h3 class="mb-3">Tambah Pelanggan</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                @include('pelanggan._form')
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
