<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama',
        'no_telp',
        'jabatan',
    ];

    // One to many: satu pegawai menangani banyak transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'pegawai_id', 'id_pegawai');
    }
}
