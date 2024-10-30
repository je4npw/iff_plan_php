@if(isset($unidade))
    <!-- Modal para visualizar a unidade -->
    <div id="viewUnitModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-2xl font-bold mb-4">Detalhes da Unidade</h2>
            <div class="mb-4">
                <label class="block text-gray-700">Nome:</label>
                <p class="border rounded p-2">{{ $unidade->nome }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">CNPJ:</label>
                <p class="border rounded p-2">{{ $unidade->cnpj }}</p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="toggleModal('viewUnitModal', false)"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Fechar
                </button>
            </div>
        </div>
    </div>
@else
    <p>Unidade não encontrada.</p>
@endif

<script>
    function toggleModal(modalId, show) {
        document.getElementById(modalId).style.display = show ? 'flex' : 'none';
    }
</script>
