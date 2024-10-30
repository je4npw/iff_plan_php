<div id="editGroupModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h2 class="text-2xl font-bold mb-4">Editar Grupo</h2>
        @if(isset($group))
            <form action="{{ route('groups.update', $group->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nome</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $group->name) }}" class="border rounded w-full py-2 px-3" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="toggleModal('editGroupModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Atualizar Grupo</button>
                </div>
            </form>
        @else
            <p>Grupo não encontrado.</p>
        @endif
    </div>
</div>
