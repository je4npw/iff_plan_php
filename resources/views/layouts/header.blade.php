<header class="bg-green-900 text-white p-4 shadow-md">
    <nav class="container mx-auto flex justify-between items-center">
        <div class="flex flex-row gap-5">
            <a href="{{route('home')}}" class="text-xl font-bold">IFF Plan |></a>
            <ul class="flex flex-row gap-2">
                <li>
                    <a class="text-xl" href="{{route('users.index')}}">Usuários</a>
                </li>
                <li>
                    <a class="text-xl" href="{{route('upload')}}">Upload</a>

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
