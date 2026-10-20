<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel penghubung (junction table) untuk relasi many to many
        // antara Transaksi dan Layanan
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id('id_detail');

            $table->foreignId('transaksi_id')
                ->constrained('transaksis', 'id_transaksi')
                ->onDelete('cascade');

            $table->foreignId('layanan_id')
                ->constrained('layanans', 'id_layanan')
                ->onDelete('cascade');

            $table->decimal('qty_berat', 8, 2); // jumlah kg / pcs
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
