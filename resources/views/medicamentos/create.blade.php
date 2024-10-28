@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-5">Adicionar Medicamento</h1>
        <form action="{{ route('medicamentos.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nome:</label>
                <input type="text" name="nome" required class="w-full border rounded px-3 py-2"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Dosagem:</label>
                <input type="text" name="dosagem" required class="w-full border rounded px-3 py-2"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Descrição:</label>
                <textarea name="descricao" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('medicamentos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
            </div>
        </form>
    </div>
@endsection
