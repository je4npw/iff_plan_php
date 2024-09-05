@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-6">Detalhes do Usuário</h1>

        <div class="mb-4">
            <strong>ID:</strong> {{ $user->id }}
        </div>
        <div class="mb-4">
            <strong>Nome:</strong> {{ $user->name }}
        </div>
        <div class="mb-4">
            <strong>Email:</strong> {{ $user->email }}
        </div>

        <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Voltar</a>
    </div>
@endsection
