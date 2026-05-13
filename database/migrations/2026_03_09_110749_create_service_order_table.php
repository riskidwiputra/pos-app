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
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->constrained('service_categories')->restrictOnDelete();
            // Customer Info
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            
            // Order Details
            $table->string('order_title');
            $table->text('order_description');
            $table->integer('quantity');
            
            // Dates
            $table->date('order_date')->nullable();
            $table->date('estimated_completion_date')->nullable();
            $table->date('actual_completion_date')->nullable();
            
            // Pricing
            $table->integer('total_price')->nullable();
            $table->integer('down_payment')->nullable()->default(0);
            $table->integer('payment')->default(0);
            
            // Files
            $table->string('design_file')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])->default('belum_lunas');
            
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
