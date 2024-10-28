<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'dosagem',
        'descricao',
    ];

    public function moradores()
    {
        return $this->belongsToMany(Morador::class, 'moradores_medicamentos')
            ->withPivot(['quantidade', 'data_entrada', 'data_renovacao', 'horario'])
            ->withTimestamps();
    }
}
