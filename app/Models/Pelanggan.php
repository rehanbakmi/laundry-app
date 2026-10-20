<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama',
        'no_telp',
        'alamat',
    ];

    // One to many: satu pelanggan punya banyak transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'pelanggan_id', 'id_pelanggan');
    }
}
