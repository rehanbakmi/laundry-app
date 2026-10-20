@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
    <h3 class="mb-3">Edit Pembayaran</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pembayaran.update', $pembayaran) }}" method="POST">
                @csrf
                @method('PUT')
                @include('pembayaran._form')
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
