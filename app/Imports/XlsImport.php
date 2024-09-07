<?php

namespace App\Imports;

use App\Models\Acolhido;
use Maatwebsite\Excel\Concerns\ToModel;

class XlsImport implements ToModel
{
    public function model(array $row)
    {
        return new Acolhido([
            'data_cadastro' => $row[0],
            'nome' => $row[1],
            'unidade' => $row[2],

        ]);
    }
}
