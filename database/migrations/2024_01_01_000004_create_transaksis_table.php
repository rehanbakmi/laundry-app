<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');

            // FK ke pelanggan -> relasi one to many (1 pelanggan banyak transaksi)
            $table->foreignId('pelanggan_id')
                ->constrained('pelanggans', 'id_pelanggan')
                ->onDelete('cascade');

            // FK ke pegawai -> relasi one to many (1 pegawai menangani banyak transaksi)
            $table->foreignId('pegawai_id')
                ->constrained('pegawais', 'id_pegawai')
                ->onDelete('cascade');

            $table->date('tanggal_masuk');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['diproses', 'selesai', 'diambil'])->default('diproses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
