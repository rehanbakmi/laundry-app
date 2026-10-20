<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pegawai->nama ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">No. Telp</label>
    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $pegawai->no_telp ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Jabatan</label>
    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $pegawai->jabatan ?? '') }}" required>
</div>
