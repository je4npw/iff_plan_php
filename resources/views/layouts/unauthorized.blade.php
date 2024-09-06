@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-red-600 mb-4">Acesso Negado</h1>
            <p class="text-lg">Você não tem permissão para acessar esta página.</p>
            <a href="{{ url('/home') }}" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded">Voltar para a Página Inicial</a>
        </div>
    </div>
@endsection
