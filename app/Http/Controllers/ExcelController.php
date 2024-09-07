<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DOMDocument;

class ExcelController extends Controller
{
    public function showForm()
    {
        return view('excel.upload');
    }

    public function upload(Request $request)
    {
        // Validação do arquivo
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        // Salvar o arquivo no storage
        $file = $request->file('file');
        $path = $file->store('excel_uploads', 'public');

        // Obter o caminho completo do arquivo salvo
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            return redirect()->route('upload.form')->with('error', 'Arquivo não encontrado.');
        }

        try {
            // Ler o conteúdo HTML do arquivo
            $htmlContent = file_get_contents($fullPath);

            // Inicializa o objeto DOMDocument para processar o HTML
            $dom = new DOMDocument;
            @$dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            // Processar o conteúdo HTML, por exemplo, extrair tabelas
            $tables = $dom->getElementsByTagName('table');
            $data = [];

            foreach ($tables as $table) {
                $rows = $table->getElementsByTagName('tr');

                foreach ($rows as $row) {
                    $rowArray = [];
                    $cells = $row->getElementsByTagName('td');

                    foreach ($cells as $cell) {
                        $rowArray[] = $cell->textContent;
                    }

                    if (!empty($rowArray)) {
                        $data[] = $rowArray;
                    }
                }
            }

            // Exemplo: Exibir o array
            dd($data);

            return redirect()->route('upload.form')->with('success', 'Arquivo importado com sucesso!');
        } catch (Exception $e) {
            // Redirecionar com mensagem de erro
            return redirect()->route('upload.form')->with('error', 'Erro ao importar o arquivo: ' . $e->getMessage());
        }
    }
}
