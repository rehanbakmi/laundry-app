@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
    <h3 class="mb-3">Tambah Transaksi</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="pelanggan_id" class="form-select" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pegawai</label>
                        <select name="pegawai_id" class="form-select" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="diproses">diproses</option>
                            <option value="selesai">selesai</option>
                            <option value="diambil">diambil</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai (opsional)</label>
                        <input type="date" name="tanggal_selesai" class="form-control">
                    </div>
                </div>

                <hr>
                <h5>Detail Layanan</h5>
                <p class="text-muted small">Satu transaksi bisa berisi lebih dari satu layanan (relasi many to many).</p>

                <div id="detail-wrapper">
                    <div class="row detail-row mb-2">
                        <div class="col-md-6">
                            <select name="layanan_id[]" class="form-select" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach ($layanans as $layanan)
                                    <option value="{{ $layanan->id_layanan }}" data-harga="{{ $layanan->harga }}">
                                        {{ $layanan->nama_layanan }} (Rp{{ number_format($layanan->harga, 0, ',', '.') }}/{{ $layanan->satuan }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" step="0.01" name="qty_berat[]" class="form-control" placeholder="Qty / berat" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger w-100 btn-remove-row" disabled>Hapus</button>
                        </div>
                    </div>
                </div>

                <button type="button" id="btn-add-row" class="btn btn-outline-primary btn-sm mb-3">+ Tambah Layanan Lain</button>

                <div>
                    <button class="btn btn-primary">Simpan Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.getElementById('btn-add-row').addEventListener('click', function () {
    const wrapper = document.getElementById('detail-wrapper');
    const firstRow = wrapper.querySelector('.detail-row');
    const newRow = firstRow.cloneNode(true);

    newRow.querySelectorAll('select, input').forEach(el => el.value = '');
    newRow.querySelector('.btn-remove-row').disabled = false;

    wrapper.appendChild(newRow);
});

document.getElementById('detail-wrapper').addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-remove-row')) {
        const rows = document.querySelectorAll('.detail-row');
        if (rows.length > 1) {
            e.target.closest('.detail-row').remove();
        }
    }
});
</script>
@endsection
