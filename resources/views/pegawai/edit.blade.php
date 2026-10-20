@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
    <h3 class="mb-3">Edit Pegawai</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.update', $pegawai) }}" method="POST">
                @csrf
                @method('PUT')
                @include('pegawai._form')
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
