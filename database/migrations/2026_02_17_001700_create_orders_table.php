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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status'); // pending|paid|processing|shipped|delivered|cancelled|refunded
            $table->integer('subtotal_cents')->default(0);
            $table->integer('vat_cents')->default(0);
            $table->integer('shipping_cents')->default(0);
            $table->integer('total_cents')->default(0);
            $table->foreignId('billing_address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->foreignId('shipping_address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->string('customer_type'); // b2c|b2b
            $table->string('codice_fiscale')->nullable();
            $table->string('partita_iva')->nullable();
            $table->string('sdi_code')->nullable();
            $table->string('pec_email')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('user_id');
            $table->index('customer_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
