@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-6">Lista de Usuários</h1>

        {{-- Apenas administradores podem ver esta seção --}}
        @can('edit')
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Adicionar Usuário</a>
        @endcan

        @if(session('success'))
            <div class="mt-4 bg-green-100 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full mt-6">
            <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Email</th>
                @can('edit')
                    <th class="px-4 py-2">Ações</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    @can('edit')
                        <td class="border px-4 py-2">
                            {{-- Verifica se o usuário pode editar --}}
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="bg-yellow-500 text-white px-4 py-2 rounded">Editar
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Excluir</button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
