<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Passer category_id de RESTRICT à SET NULL.
     * Les produits restent en base quand leur catégorie est supprimée,
     * mais category_id devient null — réassignable depuis Filament.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // 1. Supprimer l'ancienne contrainte RESTRICT
            $table->dropForeign(['category_id']);

            // 2. Rendre la colonne nullable
            $table->unsignedBigInteger('category_id')->nullable()->change();

            // 3. Recréer la contrainte avec SET NULL
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Revenir à RESTRICT (état d'origine).
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);

            $table->unsignedBigInteger('category_id')->nullable(false)->change();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');
        });
    }
};
