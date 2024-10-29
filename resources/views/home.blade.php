@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Dashboard</h1>

        <div class="grid grid-cols-3 gap-6">
            <!-- Card 1 -->
            <a href="{{route('moradores.index')}}">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Moradores Ativos</h2>
                    <p class="text-gray-600 text-lg">{{ $activeUsersCount }}</p>
                </div>
            </a>
        </div>
    </div>
@endsection

