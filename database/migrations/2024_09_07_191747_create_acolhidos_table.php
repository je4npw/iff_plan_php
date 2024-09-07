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
        Schema::create('acolhidos', function (Blueprint $table) {
            $table->id();
            $table->date('data_cadastro'); // Coluna para data de cadastro
            $table->string('nome');        // Coluna para nome do acolhido
            $table->string('unidade');     // Coluna para unidade do acolhido
            $table->timestamps();          // Colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acolhidos');
    }
};
