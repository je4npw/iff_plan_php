<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
        <input type="text" name="nome" value="{{ old('nome', $morador->nome ?? '') }}" required
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="grid grid-cols-3 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Data de Cadastro:</label>
            <input type="date" name="data_cadastro" value="{{ old('data_cadastro', $morador->data_cadastro ?? now()->format('Y-m-d')) }}" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="{{ old('data_nascimento', $morador->data_nascimento ?? '') }}" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
            <select name="status" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="" disabled selected>Selecione</option>
                <option value="ativo" {{ old('status', $morador->status ?? '') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status', $morador->status ?? '') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                <option value="triagem" {{ old('status', $morador->status ?? '') == 'triagem' ? 'selected' : '' }}>Triagem</option>
            </select>
        </div>
    </div>

    <div>
        <label class="block text-gray-700 text-sm font-bold mb-2">Nome da Mãe:</label>
        <input type="text" name="nome_mae" value="{{ old('nome_mae', $morador->nome_mae ?? '') }}"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="grid grid-cols-3 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Sexo:</label>
            <select name="sexo" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="" disabled selected>Selecione</option>
                <option value="Masculino" {{ old('sexo', $morador->sexo ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Feminino" {{ old('sexo', $morador->sexo ?? '') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                <option value="Outro" {{ old('sexo', $morador->sexo ?? '') == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Morador de Rua:</label>
            <select name="morador_de_rua" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="0" {{ old('morador_de_rua', $morador->morador_de_rua ?? '0') == '0' ? 'selected' : '' }}>Não</option>
                <option value="1" {{ old('morador_de_rua', $morador->morador_de_rua ?? '0') == '1' ? 'selected' : '' }}>Sim</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Unidade:</label>
            <select name="unidade_id" required class="w-full border rounded px-3 py-2">
                @foreach($unidades as $unidade)
                    <option value="{{ $unidade->id }}" {{ (isset($morador) && $morador->unidade_id == $unidade->id) ? 'selected' : '' }}>{{ $unidade->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="block text-gray-700 text-sm font-bold mb-2">Profissão:</label>
        <input type="text" name="profissao" value="{{ old('profissao', $morador->profissao ?? '') }}"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="grid grid-cols-4 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
            <input type="text" name="cpf" value="{{ old('cpf', $morador->cpf ?? '') }}" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">RG:</label>
            <input type="text" name="rg" value="{{ old('rg', $morador->rg ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">NIS:</label>
            <input type="text" name="nis" value="{{ old('nis', $morador->nis ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">CNS:</label>
            <input type="text" name="cns" value="{{ old('cns', $morador->cns ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
    </div>
    <div>
        <label class="block text-gray-700 text-sm font-bold mb-2">Origem da Busca:</label>
        <input type="text" name="origem_da_busca" value="{{ old('origem_da_busca', $morador->origem_da_busca ?? '') }}"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Convênio:</label>
            <input type="text" name="convenio" value="{{ old('convenio', $morador->convenio ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Tipo de Vaga:</label>
            <select name="tipo_de_vaga" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="social" {{ old('tipo_de_vaga', $morador->tipo_de_vaga ?? 'social') == 'social' ? 'selected' : '' }}>Social</option>
                <option value="particular" {{ old('tipo_de_vaga', $morador->tipo_de_vaga ?? 'social') == 'particular' ? 'selected' : '' }}>Particular</option>
                <option value="convenio" {{ old('tipo_de_vaga', $morador->tipo_de_vaga ?? 'social') == 'convenio' ? 'selected' : '' }}>Convênio</option>
            </select>
        </div>
    </div>

</div>
