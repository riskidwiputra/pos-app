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
       Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->unique();
            $table->foreignId('customer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('transaction_date')->comment('Tanggal transaksi');
            $table->enum('payment_method', ['cash', 'transfer'])->default('cash')->comment('Metode pembayaran');
            $table->text('notes')->nullable()->comment('Catatan transaksi');
            $table->decimal('total', 15, 2)->default(0)->comment('Total akhir');
            
            // Pembayaran
            $table->decimal('paid_amount', 15, 2)->default(0)->comment('Uang dibayar');
            $table->decimal('change_amount', 15, 2)->default(0)->comment('Kembalian');
            
            $table->enum('status', ['lunas','Dibatalan', 'belum-lunas'])->default('lunas');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('invoice_number');
            $table->index('transaction_date');
            $table->index('customer_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
