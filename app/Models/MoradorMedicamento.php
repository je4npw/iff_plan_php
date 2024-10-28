<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoradorMedicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'morador_id',
        'medicamento_id',
        'quantidade',
        'data_entrada',
        'data_renovacao',
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function morador()
    {
        return $this->belongsTo(Morador::class); // Supondo que você tenha um modelo Morador
    }

    public function tomadas()
    {
        return $this->hasMany(Tomada::class);
    }

}
