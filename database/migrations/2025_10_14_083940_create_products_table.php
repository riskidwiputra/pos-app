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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('restrict');
            $table->foreignId('unit_id')->constrained('units')->onDelete('restrict');
            $table->string('nama_produk');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_jual', 15, 2);
            $table->integer('stok_tersedia')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->string('barcode_product')->unique();
            $table->string('gambar_barang')->nullable();
            $table->enum('status_product', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['category_id', 'sub_category_id']);
            $table->index('stok_tersedia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
