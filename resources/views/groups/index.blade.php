@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold">Grupos</h1>
        <button onclick="toggleModal('createGroupModal', true)" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded">Adicionar Grupo</button>

        @if($groups->isNotEmpty())
            <div class="bg-white shadow-md rounded overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/4 px-4 py-2 text-left">Nome</th>
                        <th class="w-1/4 px-4 py-2 text-left">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                            <td class="border px-4 py-2">{{ $group->name }}</td>
                            <td class="border px-4 py-2 flex flex-row gap-2">
                                <button onclick="toggleModal('editGroupModal', true)" class="bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded">Editar</button>
                                <form action="{{ route('groups.destroy', $group->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @include('groups.create') <!-- Inclui o modal de criação -->
    @include('groups.edit')   <!-- Inclui o modal de edição -->
@endsection

@push('scripts')
    <script>
        function toggleModal(modalId, show) {
            document.getElementById(modalId).style.display = show ? 'flex' : 'none';
        }
    </script>
@endpush
