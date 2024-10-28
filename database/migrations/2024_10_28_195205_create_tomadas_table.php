<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::create('tomadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('morador_medicamento_id')->constrained('moradores')->onDelete('cascade');
            $table->dateTime('data_tomada');
            $table->enum('status', ['tomado', 'não tomado'])->default('não tomado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tomadas');
    }
};
