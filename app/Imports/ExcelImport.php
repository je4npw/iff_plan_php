<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class ExcelImport implements ToArray
{
    public function array(array $array)
    {
        // Process the data
        return $array;
    }
}
