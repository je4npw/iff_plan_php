<!-- Exemplo do arquivo de listagem (unidades.blade.php) -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold">Unidades</h1>
        <button onclick="toggleModal('createUnitModal', true)" class="my-6 bg-blue-500 text-white px-4 py-2 rounded">Adicionar Nova Unidade</button>
        <div class="bg-white shadow-md rounded overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/4 px-4 py-2 text-left">Nome</th>
                    <th class="w-1/4 px-4 py-2 text-left">CNPJ</th>
                    <th class="w-1/4 px-4 py-2 text-left">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($unidades as $unidade)
                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                        <td class="border px-4 py-2">{{ $unidade->nome }}</td>
                        <td class="border px-4 py-2">{{ $unidade->cnpj }}</td>
                        <td class="border px-4 py-2 flex flex-row gap-2">
                            <!-- Botão para visualizar -->
                            <button onclick="toggleModal('viewUnitModal', true)" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                Visualizar
                            </button>

                            <!-- Botão para editar -->
                            <button onclick="toggleModal('editUnitModal', true)" class="bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded">
                                Editar
                            </button>

                            <!-- Formulário de exclusão -->
                            <form action="{{ route('unidades.destroy', $unidade->id) }}" method="POST" class="inline-block">
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
    </div>

    <!-- Modais de edição e visualização aqui -->
    @include('unidades.create') <!-- Inclui o modal de criação -->
    @include('unidades.edit') <!-- Inclui o modal de edição -->
    @include('unidades.show') <!-- Inclui o modal de visualização -->
@endsection

<!-- Script para as funções dos modais -->
@section('scripts')
    <script>
        function toggleModal(modalId, show) {
            document.getElementById(modalId).style.display = show ? 'flex' : 'none';
        }
    </script>
@endsection
