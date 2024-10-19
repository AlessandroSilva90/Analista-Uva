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
        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->foreignId('id_categoria')->nullable()->constrained('categoria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['id_categoria']); // Remover a chave estrangeira
            $table->dropColumn('id_categoria'); // Remover a coluna
        });

        Schema::dropIfExists('categoria'); // Remove a tabela categoria

    }
};
