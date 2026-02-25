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
       Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete();
            $table->string('product_name', 200);
            $table->decimal('price', 15, 2);
            $table->decimal('quantity', 10, 2);
            $table->integer('price_purchase');
            $table->string('unit', 20)->nullable()->comment('Satuan (pcs, box, dll)');
            $table->decimal('subtotal', 15, 2)->comment('Harga x Qty');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('sale_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
