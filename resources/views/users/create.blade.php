@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-6">{{ isset($user) ? 'Editar Usuário' : 'Adicionar Usuário' }}</h1>

        <form method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif
            @include('users.form')
            <div class="flex justify-between">
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($user) ? 'Atualizar' : 'Salvar' }}</button>
            </div>
        </form>
    </div>
@endsection
