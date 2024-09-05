@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-cover" style="background-image: url('/path/to/your/image.jpg');">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
            <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Login</h1>

            <form method="POST" action="{{ url('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Senha</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <!-- Botão de Login -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300 w-full">
                        Login
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">Não tem uma conta? <a href="{{ url('register') }}" class="text-blue-500 hover:text-blue-600">Registre-se</a></p>
            </div>
        </div>
    </div>
@endsection
