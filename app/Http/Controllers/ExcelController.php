<?php

namespace App\Http\Controllers;

use App\Models\Acolhido;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function showForm()
    {
        return view('excel.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:html|max:2048',
        ]);

        $file = $request->file('file');

        $fileContent = $file->get();

        try {

            $data = self::HTMLXMLtoArray($fileContent);

            foreach ($data as $acolhido) {
                $res = new Acolhido;
                $res->nome = $acolhido[1];
                $data_cadastro = Carbon::createFromFormat('d/m/Y', $acolhido[0])->format('Y-m-d');
                $res->data_cadastro = $data_cadastro;
                $res->unidade = $acolhido[2];
                $res->save();
            }

            return redirect()->route('upload.form')->with('success', count($data) . ' registros importados com sucesso!');

        } catch (Exception $e) {

            return redirect()->route('upload.form')->with('error', 'Erro ao importar o arquivo: ' . $e->getMessage());
        }
    }

    private function HTMLXMLtoArray($fileContent)
    {
        try {
            $dom = new DOMDocument;
            @$dom->loadHTML($fileContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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

            return $data;

        } catch (Exception $e) {
            return redirect()->route('upload.form')->with('error', 'Erro ao converter o arquivo: ' . $e->getMessage());
        }
    }
}
