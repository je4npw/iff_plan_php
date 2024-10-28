<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
    ];

    /**
     * Define a relação com a tabela 'moradores'.
     */
    public function moradores()
    {
        return $this->hasMany(Morador::class);
    }
}
