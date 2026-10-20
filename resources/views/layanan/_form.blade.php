<div class="mb-3">
    <label class="form-label">Nama Layanan</label>
    <input type="text" name="nama_layanan" class="form-control" value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}" placeholder="Contoh: Cuci Kering, Setrika" required>
</div>

<div class="mb-3">
    <label class="form-label">Harga</label>
    <input type="number" step="0.01" name="harga" class="form-control" value="{{ old('harga', $layanan->harga ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Satuan</label>
    <select name="satuan" class="form-select" required>
        @foreach (['kg', 'pcs', 'set'] as $satuan)
            <option value="{{ $satuan }}" @selected(old('satuan', $layanan->satuan ?? '') == $satuan)>{{ $satuan }}</option>
        @endforeach
    </select>
</div>
