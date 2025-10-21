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
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('restrict');
            $table->string('nama_invoice')->unique();
            $table->string('tgl_invoice');
            $table->string('tanggal_terima_barang');
            $table->enum('status', ['Lunas', 'Belum-lunas', 'Dibatalkan'])->default('Lunas');
            $table->decimal('total_pembelian', 15, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['supplier_id', 'tgl_invoice']);
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
