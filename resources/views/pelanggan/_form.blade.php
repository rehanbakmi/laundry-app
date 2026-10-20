<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">No. Telp</label>
    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $pelanggan->no_telp ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
</div>
