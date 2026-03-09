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
         Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique()->index();
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            
            // Customer Info
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            
            // Order Details
            $table->string('order_title');
            $table->text('order_description');
            $table->integer('quantity');
            $table->string('unit'); // pcs, lembar, meter, set, dll
            
            // Dates
            $table->date('order_date');
            $table->date('estimated_completion_date');
            $table->date('actual_completion_date')->nullable();
            
            // Pricing
            $table->integer('total_price');
            $table->integer('down_payment')->nullable()->default(0);
            $table->integer('payment')->default(0);
            
            // Files
            $table->string('design_file')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])->default('belum lunas');
            
            // Status
            $table->enum('status', [
                'pending',      // Menunggu persetujuan admin
                'approved',     // Disetujui admin
                'rejected',     // Ditolak admin
                'in_progress',  // Sedang dikerjakan
                'completed',    // Selesai dikerjakan
                'cancelled'     // Dibatalkan
            ])->default('pending')->index();
            
            $table->text('rejection_reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_order');
    }
};
