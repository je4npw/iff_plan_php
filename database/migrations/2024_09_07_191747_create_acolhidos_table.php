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
        Schema::create('acolhidos', function (Blueprint $table) {
            $table->id();
            $table->date('data_cadastro')->nullable();
            $table->string('nome');
            $table->string('unidade')->nullable();
            $table->string('sexo', 10)->nullable();
            $table->string('cpf', 14)->unique();
            $table->string('rg', 20)->nullable();
            $table->string('nis', 20)->nullable();
            $table->string('cns', 20)->nullable();
            $table->date('data_nascimento');
            $table->string('profissao')->nullable();
            $table->boolean('morador_de_rua')->default(false);
            $table->enum('tipo_de_vaga', ['social', 'particular', 'convenio'])
                ->default('convenio');
            $table->string('origem_da_busca')->nullable();
            $table->string('convenio')->nullable();
            $table->enum('status', ['ativo', 'inativo', 'triagem'])
                ->default('ativo');
            $table->string('cidade')->nullable();
            $table->string('nome_mae')->nullable();
            $table->timestamps();
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
