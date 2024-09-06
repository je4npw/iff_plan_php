<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Http\Requests\UploadExcelRequest;

class ExcelController extends Controller
{
    public function showForm()
    {
        return view('excel.upload');
    }

    public function upload(UploadExcelRequest $request)
    {
        try {
            $file = $request->file('file');
            $import = new ExcelImport();

            // Processar o arquivo e retornar os dados
            $data = Excel::toArray($import, $file);

            // Redirecionar com uma mensagem de sucesso
            return redirect()->route('upload.form')->with('success', 'Arquivo importado com sucesso.');
        } catch (\Exception $e) {
            // Redirecionar com uma mensagem de erro
            return redirect()->route('upload.form')->with('error', 'Ocorreu um erro ao importar o arquivo.');
        }
    }
}
