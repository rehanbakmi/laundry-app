<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'pelanggan_id',
        'pegawai_id',
        'tanggal_masuk',
        'tanggal_selesai',
        'status',
    ];

    // Belongs to: many to one ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id_pelanggan');
    }

    // Belongs to: many to one ke Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_pegawai');
    }

    // Relasi langsung ke tabel penghubung (untuk simpan qty & subtotal per item)
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'id_transaksi');
    }

    // Many to many ke Layanan lewat detail_transaksis
    public function layanans()
    {
        return $this->belongsToMany(
            Layanan::class,
            'detail_transaksis',
            'transaksi_id',
            'layanan_id',
            'id_transaksi',
            'id_layanan'
        )->withPivot('id_detail', 'qty_berat', 'subtotal')->withTimestamps();
    }

    // One to many: satu transaksi bisa punya beberapa catatan pembayaran (cicilan)
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'transaksi_id', 'id_transaksi');
    }
}
