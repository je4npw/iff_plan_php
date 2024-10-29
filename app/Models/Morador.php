<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    use HasFactory;

    protected $table = 'moradores';
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
        'unidade_id',
        'imagem',
    ];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'moradores_medicamentos')
            ->withPivot(['quantidade', 'data_entrada', 'data_renovacao', 'horario'])
            ->withTimestamps();
    }
}
