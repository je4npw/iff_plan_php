@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Dashboard</h1>

        <div class="grid grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Usuários Ativos</h2>
                <p class="text-gray-600 text-lg">1,234</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Vendas Hoje</h2>
                <p class="text-gray-600 text-lg">R$ 12,345.67</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Novos Cadastros</h2>
                <p class="text-gray-600 text-lg">567</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Comentários</h2>
                <p class="text-gray-600 text-lg">89</p>
            </div>

            <!-- Card 5 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Transações Pendentes</h2>
                <p class="text-gray-600 text-lg">45</p>
            </div>

            <!-- Card 6 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Lucro Mensal</h2>
                <p class="text-gray-600 text-lg">R$ 98,765.43</p>
            </div>

            <!-- Card 7 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Pedidos em Aberto</h2>
                <p class="text-gray-600 text-lg">23</p>
            </div>

            <!-- Card 8 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Tickets Suporte</h2>
                <p class="text-gray-600 text-lg">7</p>
            </div>

            <!-- Card 9 -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Novos Leads</h2>
                <p class="text-gray-600 text-lg">345</p>
            </div>
        </div>
    </div>
@endsection

