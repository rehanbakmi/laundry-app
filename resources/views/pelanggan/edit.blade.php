@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <h3 class="mb-3">Edit Pelanggan</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
                @csrf
                @method('PUT')
                @include('pelanggan._form')
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
