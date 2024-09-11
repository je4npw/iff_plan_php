@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-3xl font-bold mb-5">Criar Acolhido</h1>
            <form action="{{ route('acolhidos.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text" name="nome" value="{{ old('nome') }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Data de Cadastro:</label>
                    <input type="text" name="data_cadastro" value="{{ old('data_cadastro') }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Unidade:</label>
                    <input type="text" name="unidade" value="{{ old('unidade') }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Sexo:</label>
                    <input type="text" name="sexo" value="{{ old('sexo') }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                    <input type="text" name="cpf" value="{{ old('cpf') }}" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <!-- Adicione outros campos conforme necessário -->
                <div class="flex space-x-4">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Salvar
                    </button>
                    <a href="{{ route('acolhidos.index') }}"
                       class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
