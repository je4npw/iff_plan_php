@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-6">{{ isset($user) ? 'Editar Usuário' : 'Adicionar Usuário' }}</h1>

        <form method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Senha</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded">
                @if(isset($user))
                    <small class="text-gray-600">Deixe em branco se não quiser alterar a senha</small>
                @endif
            </div>

            <div class="flex justify-between">
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($user) ? 'Atualizar' : 'Salvar' }}</button>
            </div>
        </form>
    </div>
@endsection
