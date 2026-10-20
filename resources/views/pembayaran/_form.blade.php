<div class="mb-3">
    <label class="form-label">Transaksi</label>
    <select name="transaksi_id" class="form-select" required>
        <option value="">-- Pilih Transaksi --</option>
        @foreach ($transaksis as $t)
            <option value="{{ $t->id_transaksi }}" @selected(old('transaksi_id', $pembayaran->transaksi_id ?? '') == $t->id_transaksi)>
                #{{ $t->id_transaksi }} - {{ $t->pelanggan->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Tanggal Bayar</label>
    <input type="date" name="tanggal_bayar" class="form-control" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Metode Bayar</label>
    <select name="metode_bayar" class="form-select" required>
        @foreach (['tunai', 'transfer', 'qris'] as $metode)
            <option value="{{ $metode }}" @selected(old('metode_bayar', $pembayaran->metode_bayar ?? '') == $metode)>{{ $metode }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Jumlah Bayar</label>
    <input type="number" step="0.01" name="jumlah_bayar" class="form-control" value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar ?? '') }}" required>
</div>
