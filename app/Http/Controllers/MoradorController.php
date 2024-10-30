<?php

namespace App\Http\Controllers;

use App\Models\Morador;
use App\Models\Unidade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

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
            // Validação da requisição
            $validatedData = $request->validate([
                'imagem_temp' => 'nullable|url',
                'nome' => 'required|string|max:255',
                'data_cadastro' => 'required|date',
                'data_nascimento' => 'required|date',
                'status' => 'required|string|max:50',
                'nome_mae' => 'nullable|string|max:255',
                'sexo' => 'required|string|max:10',
                'morador_de_rua' => 'required|boolean',
                'unidade_id' => 'required|exists:unidades,id',
                'profissao' => 'required|string|max:100',
                'cpf' => 'required|string|max:14',
                'rg' => 'nullable|string|max:20',
                'nis' => 'nullable|string|max:20',
                'cns' => 'nullable|string|max:20',
                'origem_da_busca' => 'required|string|max:100',
                'convenio' => 'required|string|max:100',
                'tipo_de_vaga' => 'required|string|max:50',
            ]);

            // Remove o domínio da URL da imagem
            $url = parse_url($request->imagem_temp);
            $caminhoImagem = $url['path']; // Obtém apenas o caminho

            // Armazene o morador com a URL da imagem temporária
            Morador::create(array_merge($validatedData, [
                'imagem' => $caminhoImagem, // Adiciona a URL da imagem temporária
            ]));

            // Redireciona ou retorna uma resposta
            return redirect()->route('moradores.index')->with('success', 'Morador cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Registra o erro no log do Laravel
            \Log::error('Erro ao cadastrar morador: ' . $e->getMessage(), ['exception' => $e]);

            // Retorna uma resposta de erro para o usuário
            return redirect()->back()->withErrors('Ocorreu um erro ao cadastrar o morador. Por favor, tente novamente.');
        }
    }

    public function show($id)
    {
        $morador = Morador::find($id);

        if (!$morador) {
            return redirect()->route('moradores.index')->with('error', 'Morador não encontrado.');
        }

        return view('moradores.show', compact('morador'));
    }

    public function edit(Morador $morador)
    {
        $unidades = Unidade::all(); // caso precise passar as unidades para a view

        return view('moradores.edit', compact('morador', 'unidades'));
    }

    public function update(Request $request, Morador $morador)
    {
        try {
            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'data_cadastro' => 'required|date_format:Y-m-d',
                'unidade_id' => 'required|exists:unidades,id',
                'sexo' => 'required|string|max:10',
                'cpf' => 'required|string|max:14|unique:moradores,cpf,' . $morador->id,
                'rg' => 'nullable|string|max:20',
                'nis' => 'nullable|string|max:20',
                'cns' => 'nullable|string|max:20',
                'data_nascimento' => 'nullable|date_format:Y-m-d',
                'profissao' => 'nullable|string|max:255',
                'morador_de_rua' => 'required|boolean',
                'tipo_de_vaga' => 'required|in:social,particular,convenio',
                'origem_da_busca' => 'nullable|string|max:255',
                'convenio' => 'nullable|string|max:255',
                'status' => 'required|in:ativo,inativo,triagem',
                'cidade' => 'nullable|string|max:255',
                'nome_mae' => 'nullable|string|max:255',
                'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Verifica se uma nova imagem foi enviada
            if ($request->hasFile('imagem')) {
                // Remove a imagem antiga se existir
                if ($morador->imagem) {
                    Storage::delete('public/' . $morador->imagem);
                }

                $image = $request->file('imagem');
                $imagePath = 'moradores/' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Manipulação da imagem com Intervention
                $img = Image::make($image->getRealPath())
                    ->fit(300, 300, function ($constraint) {
                        $constraint->upsize(); // Garante que a imagem não seja ampliada além do tamanho original
                    })
                    ->save(storage_path('app/public/' . $imagePath)); // Salva a imagem recortada

                $validated['imagem'] = $imagePath; // Salva o caminho da nova imagem no banco de dados
            }

            // Atualiza o morador
            $morador->update($validated);

            return redirect()->route('moradores.index')->with('success', 'Morador atualizado com sucesso!');

        } catch (ValidationException $e) {
            // Exibe os erros de validação
            dd($e->validator->errors());
        }
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

    public function uploadImagem(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imagePath = $request->file('imagem')->store('imagens_moradores', 'public');

            return response()->json([
                'success' => true,
                'imageUrl' => asset('storage/' . $imagePath),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao fazer upload da imagem: ' . $e->getMessage(),
            ], 500);
        }
    }

}
