<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_code', 50)->unique();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('nomor_invoice', 100);
            $table->date('tgl_invoice');
            $table->date('tanggal_terima_barang');
            $table->integer('total_harga')->default(0);
            $table->integer('jumlah_dibayar')->default(0);
            $table->integer('sisa_tagihan')->default(0);
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->enum('status', ['Aktif', 'Dibatalkan'])->default('Aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('purchase_code');
            $table->index('supplier_id');
            $table->index('tgl_invoice');
            $table->index('tanggal_terima_barang');
            $table->index('status_pembayaran');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
