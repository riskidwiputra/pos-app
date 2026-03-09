<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jasa', 150);
            $table->text('deskripsi')->nullable();

            // Harga
            $table->unsignedBigInteger('harga_dasar')->default(0);
            $table->unsignedBigInteger('harga_maksimal')->nullable();
          

            // Bahan & Material
            $table->text('keterangan_bahan')->nullable();

            // Media & Status
            $table->string('gambar_contoh')->nullable();
            $table->boolean('is_active')->default(true);

            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
            
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_kategori_order');
    }
};
