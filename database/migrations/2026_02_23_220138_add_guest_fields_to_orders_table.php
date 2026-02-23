<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Campi guest checkout — salvati inline nell'ordine
            $table->string('guest_name')->nullable()->after('user_id');
            $table->string('guest_email')->nullable()->after('guest_name');
            $table->string('guest_phone')->nullable()->after('guest_email');
            $table->string('shipping_street')->nullable()->after('guest_phone');
            $table->string('shipping_city')->nullable()->after('shipping_street');
            $table->string('shipping_postal_code')->nullable()->after('shipping_city');
            $table->string('shipping_province', 2)->nullable()->after('shipping_postal_code');
            $table->text('notes')->nullable()->after('shipping_province');
            $table->integer('discount_cents')->default(0)->after('notes');

            // Rendi nullable le colonne richieste in precedenza
            $table->string('status')->default('pending')->change();
            $table->string('customer_type')->default('b2c')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'guest_name',
                'guest_email',
                'guest_phone',
                'shipping_street',
                'shipping_city',
                'shipping_postal_code',
                'shipping_province',
                'notes',
                'discount_cents',
            ]);
        });
    }
};
