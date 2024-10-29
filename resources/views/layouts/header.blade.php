<header class="bg-green-900 text-white p-4 shadow-md h-16"> <!-- Altura fixa -->
    <nav class="container mx-auto flex justify-between items-center h-full"> <!-- Habilitar h-full para o nav -->
        <div class="flex flex-row gap-5 items-center h-full"> <!-- Habilitar h-full para o div -->
            <a href="{{ route('home') }}" class="text-xl font-bold">IFF Plan |&gt;</a>
            <ul class="flex flex-row gap-2">
                @auth()
                    <li class="hover:text-amber-500">
                        <a class="text-xl" href="{{ route('users.index') }}">Usuários</a>
                    </li>
{{--                    <li class="hover:text-amber-500">--}}
{{--                        <a class="text-xl" href="{{ route('upload.form') }}">Upload</a>--}}
{{--                    </li>--}}
                    <li class="hover:text-amber-500">
                        <a class="text-xl" href="{{ route('moradores.index') }}">Moradores</a>
                    </li>
                    <li class="hover:text-amber-500">
                        <a class="text-xl" href="{{ route('unidades.index') }}">Unidades</a>
                    </li>
                @endauth
            </ul>
        </div>
        <div class="grid grid-cols-2 gap-2">
            @auth()
                <div class="text-white rounded"> <!-- Ajuste feito aqui -->
                    {{ trim(auth()->user()->name)}}
                </div>
            @endauth
            <div>
                @auth
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white rounded">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
</header>
