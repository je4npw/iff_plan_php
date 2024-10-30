<div id="createGroupModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h2 class="text-2xl font-bold mb-4">Adicionar Grupo</h2>
        <form action="{{ route('groups.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nome:</label>
                <input type="text" name="name" required class="w-full border rounded px-3 py-2"/>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="toggleModal('createGroupModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
            </div>
        </form>
    </div>
</div>
