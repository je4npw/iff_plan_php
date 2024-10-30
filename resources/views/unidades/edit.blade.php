<!-- Modal para editar a unidade -->
<div id="editUnitModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h2 class="text-2xl font-bold mb-4">Editar Unidade</h2>
        @if(isset($unidade))
        <form action="{{ route('unidades.update', $unidade->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nome" class="block text-gray-700">Nome</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome', $unidade->nome) }}"
                       class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="cnpj" class="block text-gray-700">CNPJ</label>
                <input type="text" id="cnpj" name="cnpj" value="{{ old('cnpj', $unidade->cnpj) }}"
                       class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="toggleModal('editUnitModal', false)"
                        class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar
                </button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Atualizar Unidade</button>
            </div>
        </form>
        @else
            <p>Unidade não encontrada.</p>
        @endif
    </div>
</div>

<script>
    function toggleModal(modalId, show) {
        document.getElementById(modalId).style.display = show ? 'flex' : 'none';
    }
</script>
