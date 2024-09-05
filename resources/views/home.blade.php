@include('layouts.app')

<header class="bg-blue-600 text-white p-4 shadow-md">
    <nav class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-xl font-bold">IFF Plan</a>
        <ul class="flex space-x-4">
            <li>
                @auth
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                @endauth
            </li>
        </ul>
    </nav>
</header>

<main class="flex-grow container mx-auto p-6">
    <section class="bg-white shadow-md rounded p-6 text-center">
        <h1 class="text-2xl font-bold text-gray-700">Bem-vindo à Aplicação!</h1>

        @auth
            <p class="mt-4 text-lg text-gray-600">Olá, {{ auth()->user()->name }}! Você está autenticado.</p>
        @else
            <p class="mt-4 text-lg text-gray-600">
                Você não está logado.
                <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600">Faça login</a>
                ou
                <a href="{{ url('register') }}" class="text-blue-500 hover:text-blue-600">registre-se</a>.
            </p>
        @endauth
    </section>
</main>

<footer class="bg-gray-800 text-white text-center p-4">
    <p>&copy; {{ date('Y') }} - Minha Aplicação</p>
</footer>

</body>
</html>
