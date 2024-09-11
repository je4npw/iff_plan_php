<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acolhido extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_cadastro',
        'nome',
        'unidade',
        'sexo',
        'cpf',
        'rg',
        'nis',
        'cns',
        'data_nascimento',
        'profissao',
        'morador_de_rua',
        'tipo_de_vaga',
        'origem_da_busca',
        'convenio',
        'status',
        'cidade',
        'nome_mae',
    ];
}
