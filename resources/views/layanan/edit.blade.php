@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
    <h3 class="mb-3">Edit Layanan</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('layanan.update', $layanan) }}" method="POST">
                @csrf
                @method('PUT')
                @include('layanan._form')
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
