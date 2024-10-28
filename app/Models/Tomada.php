<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tomada extends Model
{
    use HasFactory;

    protected $fillable = [
        'morador_medicamento_id',
        'data_tomada',
        'status',
    ];

    public function moradorMedicamento()
    {
        return $this->belongsTo(MoradorMedicamento::class);
    }
}
