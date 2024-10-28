@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-5">Medicamentos</h1>
        <a href="{{ route('medicamentos.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-5 inline-block">Adicionar Novo</a>
        <div class="bg-white shadow-md rounded overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/4 px-4 py-2 text-left">Nome</th>
                    <th class="w-1/4 px-4 py-2 text-left">Dosagem</th>
                    <th class="w-1/4 px-4 py-2 text-left">Descrição</th>
                    <th class="w-1/4 px-4 py-2 text-left">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medicamentos as $medicamento)
                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                        <td class="border px-4 py-2">{{ $medicamento->nome }}</td>
                        <td class="border px-4 py-2">{{ $medicamento->dosagem }}</td>
                        <td class="border px-4 py-2">{{ $medicamento->descricao }}</td>
                        <td class="border px-4 py-2 flex flex-row gap-2">
                            <a href="{{ route('medicamentos.edit', $medicamento->id) }}"
                               class="bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded">Editar</a>
                            <form action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="POST"
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
