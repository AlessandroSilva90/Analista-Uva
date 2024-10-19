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
        Schema::table('carrinho', function (Blueprint $table) {

            $table->integer('porc_desconto')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carrinho', function (Blueprint $table) {
            $table->dropColumn('porc_desconto'); // Remover a coluna
        });
    }
};
