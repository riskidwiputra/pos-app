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
       Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('module'); // Nama module/kategori
            $table->string('type')->default('feature'); // 'menu' atau 'feature'
            $table->string('icon')->nullable();
            $table->string('url')->nullable(); // URL/route untuk menu
            $table->foreignId('parent_id')->nullable()->constrained('permissions')->onDelete('cascade'); // Untuk submenu
            $table->integer('order')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
