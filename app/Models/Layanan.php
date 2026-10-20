<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $primaryKey = 'id_layanan';

    protected $fillable = [
        'nama_layanan',
        'harga',
        'satuan',
    ];

    // Relasi langsung ke tabel penghubung
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'layanan_id', 'id_layanan');
    }

    // Many to many ke Transaksi lewat detail_transaksis (pivot punya kolom tambahan)
    public function transaksis()
    {
        return $this->belongsToMany(
            Transaksi::class,
            'detail_transaksis',
            'layanan_id',
            'transaksi_id',
            'id_layanan',
            'id_transaksi'
        )->withPivot('id_detail', 'qty_berat', 'subtotal')->withTimestamps();
    }
}
