@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-5">{{ $medicamento->nome }}</h1>
        <p><strong>Dosagem:</strong> {{ $medicamento->dosagem }}</p>
        <p><strong>Descrição:</strong> {{ $medicamento->descricao }}</p>
        <div class="flex justify-end mt-5">
            <a href="{{ route('medicamentos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Voltar</a>
        </div>
    </div>
@endsection
