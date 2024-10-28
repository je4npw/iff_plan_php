@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center py-24">

        <div class="bg-green-300 p-8 rounded-lg shadow-lg w-1/3">
            <h1 class="text-2xl font-semibold mb-4">Upload de Arquivo CSV: </h1>

            <!-- Mensagens de Status -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulário de Upload -->
            <form action="{{ route('moradores.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700 py-4">Selecione apenas um arquivo
                        CSV!</label>
                    <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('file')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-green-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-amber-600">
                    Enviar
                </button>
            </form>
        </div>
    </div>
@endsection
