<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('condition'); // new|refurbished
            $table->smallInteger('warranty_months')->nullable();
            $table->integer('price_cents');
            $table->decimal('vat_rate', 5, 2)->default(22.00);
            $table->integer('stock_qty')->default(0);
            $table->boolean('is_active')->default(false);
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->index('category_id');
            $table->index('brand_id');
            $table->index('sku');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
