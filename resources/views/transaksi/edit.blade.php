@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
    <h3 class="mb-3">Edit Transaksi</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi.update', $transaksi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="pelanggan_id" class="form-select" required>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id_pelanggan }}" @selected($transaksi->pelanggan_id == $pelanggan->id_pelanggan)>
                                    {{ $pelanggan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pegawai</label>
                        <select name="pegawai_id" class="form-select" required>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id_pegawai }}" @selected($transaksi->pegawai_id == $pegawai->id_pegawai)>
                                    {{ $pegawai->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach (['diproses', 'selesai', 'diambil'] as $status)
                                <option value="{{ $status }}" @selected($transaksi->status == $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" value="{{ $transaksi->tanggal_masuk }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai (opsional)</label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ $transaksi->tanggal_selesai }}">
                    </div>
                </div>

                <hr>
                <h5>Detail Layanan</h5>

                <div id="detail-wrapper">
                    @foreach ($transaksi->detailTransaksis as $detail)
                        <div class="row detail-row mb-2">
                            <div class="col-md-6">
                                <select name="layanan_id[]" class="form-select" required>
                                    @foreach ($layanans as $layanan)
                                        <option value="{{ $layanan->id_layanan }}" @selected($detail->layanan_id == $layanan->id_layanan)>
                                            {{ $layanan->nama_layanan }} (Rp{{ number_format($layanan->harga, 0, ',', '.') }}/{{ $layanan->satuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" step="0.01" name="qty_berat[]" class="form-control" value="{{ $detail->qty_berat }}" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-danger w-100 btn-remove-row" {{ $loop->count == 1 ? 'disabled' : '' }}>Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="btn-add-row" class="btn btn-outline-primary btn-sm mb-3">+ Tambah Layanan Lain</button>

                <div>
                    <button class="btn btn-primary">Update</button>
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
