<?php

namespace App\Http\Controllers;

use App\Models\Morador;
use App\Models\Unidade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Class MoradorController
 * Controller responsável por lidar com a importação de dados de moradores a partir de um arquivo CSV.
 */
class MoradorController extends Controller
{
    public function index()
    {
        $moradores = Morador::all();
        return view('moradores.index', compact('moradores'));
    }

    public function create()
    {
        $unidades = Unidade::all();
        return view('moradores.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'data_cadastro' => 'required|date_format:d/m/Y',
                'unidade' => 'required|string|max:255',
                'sexo' => 'required|string|max:10',
                'cpf' => 'required|string|max:14|unique:moradores',
                'rg' => 'nullable|string|max:20',
                'nis' => 'nullable|string|max:20',
                'cns' => 'nullable|string|max:20',
                'data_nascimento' => 'nullable|date_format:d/m/Y',
                'profissao' => 'nullable|string|max:255',
                'morador_de_rua' => 'required|boolean',
                'tipo_de_vaga' => 'required|in:social,particular,convenio',
                'origem_da_busca' => 'nullable|string|max:255',
                'convenio' => 'nullable|string|max:255',
                'status' => 'required|in:ativo,inativo,triagem',
                'cidade' => 'nullable|string|max:255',
                'nome_mae' => 'nullable|string|max:255',
            ]);

            // Formatação das datas
            $validated['data_cadastro'] = Carbon::createFromFormat('d/m/Y', $validated['data_cadastro']);
            $validated['data_nascimento'] = $validated['data_nascimento']
                ? Carbon::createFromFormat('d/m/Y', $validated['data_nascimento'])
                : null;

            Morador::create($validated);

            return redirect()->route('moradores.index')->with('success', 'Morador criado com sucesso!');

        } catch (ValidationException $e) {
            // Exibir os erros de validação
            dd($e->validator->errors());
        }
    }

    public function show(Morador $morador)
    {
        return view('moradores.show', compact('morador'));
    }

    public function edit(Morador $morador)
    {
        $unidades = Unidade::all();
        return view('moradores.edit', compact('morador'));
    }

    public function update(Request $request, Morador $morador)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data_cadastro' => 'required|date_format:d/m/Y',
            'unidade' => 'required|string|max:255',
            'sexo' => 'required|string|max:10',
            'cpf' => 'required|string|max:14',
            'rg' => 'nullable|string|max:20',
            'nis' => 'nullable|string|max:20',
            'cns' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date_format:d/m/Y',
            'profissao' => 'nullable|string|max:255',
            'morador_de_rua' => 'required|boolean',
            'tipo_de_vaga' => 'required|in:social,particular,convenio',
            'origem_da_busca' => 'nullable|string|max:255',
            'convenio' => 'nullable|string|max:255',
            'status' => 'required|in:ativo,inativo,triagem',
            'cidade' => 'nullable|string|max:255',
            'nome_mae' => 'nullable|string|max:255',
        ]);

        $validated['data_cadastro'] = Carbon::createFromFormat('d/m/Y', $validated['data_cadastro']);
        $validated['data_nascimento'] = $validated['data_nascimento']
            ? Carbon::createFromFormat('d/m/Y', $validated['data_nascimento'])
            : null;

        $morador->update($validated);

        return redirect()->route('moradores.index')->with('success', 'Morador atualizado com sucesso!');
    }

    public function destroy(Morador $morador)
    {
        $morador->delete();

        return redirect()->route('moradores.index')->with('success', 'Morador excluído com sucesso!');
    }

    /**
     * Retorna a view do formulário
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showForm()
    {
        return view('upload.form');
    }


    /**
     * Method de importação de dados CSV
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $this->validateImportRequest($request);

        $data = $this->csvToArray($request->file('file'));

        if (empty($data)) {
            return redirect()->back()->withErrors('O arquivo CSV está vazio ou mal formatado.');
        }

        DB::beginTransaction();

        try {

            $savedCount = $this->saveImportedData($data);

            if ($savedCount == 0) return redirect()->back()->with('info', 'Nenhum registro foi importado.');

            DB::commit();

            return redirect()->back()->with('success', $savedCount . ' registros importados com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Erro ao importar os dados no registro: ' . $savedCount . ': ' . $e->getMessage());
        }
    }

    private function validateImportRequest(Request $request): void
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
    }

    /**
     * Salva os dados importados do CSV
     *
     * @param array $data
     * @return int
     */
    private function saveImportedData(array $data): int
    {
        $savedCount = 0;

        foreach ($data as $index => $row) {
            $row = $this->sanitizeData($row);
            \Log::info("Processando registro {$index}");

            try {
                $acolhido = Morador::firstOrNew(['cpf' => $row[3]]);

                $acolhido->fill([
                    'nome' => $row[1],
                    'data_cadastro' => Carbon::createFromFormat('d/m/Y', $row[0]),
                    'sexo' => $row[2],
                    'rg' => $row[4],
                    'nis' => $row[5] ?? '0',
                    'cns' => $row[6] ?? '0',
                    'data_nascimento' => Carbon::createFromFormat('d/m/Y', $row[7]),
                    'profissao' => $row[9],
                    'unidade' => $row[10],
                    'morador_de_rua' => $row[11],
                    'tipo_de_vaga' => $row[12],
                    'origem_da_busca' => $row[13],
                    'convenio' => $row[14],
                    'status' => $row[15],
                    'cidade' => $row[16],
                    'nome_mae' => $row[17],
                ]);

                $acolhido->save();
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
                return $savedCount;
            }

            $savedCount++;
            \Log::info("Registro {$index} salvo com sucesso");
        }

        return $savedCount;
    }

    /**
     * Converte o arquivo CSV em um array
     * @param $file
     * @return array
     */
    private function csvToArray($file)
    {
        $csvData = [];

        // Abrir o arquivo CSV
        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ','); // Ler o cabeçalho

            // Ler as linhas restantes do CSV
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $csvData[] = $row;
            }
            fclose($handle);
        }

        return $csvData;
    }

    private function sanitizeData(array $row): array
    {
        return array_map(function ($item, $key) {
            // Exclui os índices 0 e 7 da sanitização
            if ($key === 0 || $key === 7) {
                return $item; // Mantém os valores de data intactos
            }
            // Sanitiza os demais campos (por exemplo, substituindo '/' por espaço)
            return is_string($item) ? trim(str_replace('/', ', ', $item)) : $item;
        }, $row, array_keys($row));
    }


}
