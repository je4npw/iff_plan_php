<header class="bg-green-900 text-white p-4 shadow-md">
    <nav class="container mx-auto flex justify-between items-center">
        <div class="flex flex-row gap-5">
            <a href="/home" class="text-xl font-bold">IFF Plan |></a>
            <ul>
                <li>
                    <a class="text-xl" href="/users">Usuários</a>
                </li>
            </ul>
        </div>
        <ul class="flex space-x-4">
            @auth()
                <li class="text-white px-4 py-2 rounded border">
                    {{ auth()->user()->name }}
                </li>
            @endauth
            <li>
                @auth
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                @endauth
            </li>
        </ul>
    </nav>
</header>
