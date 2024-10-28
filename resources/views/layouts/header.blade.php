<header class="bg-green-900 text-white p-4 shadow-md">
    <nav class="container mx-auto flex justify-between items-center">
        <div class="flex flex-row gap-5">
            <a href="{{route('home')}}" class="text-xl font-bold">IFF Plan |></a>
            <ul class="flex flex-row gap-2">
                @auth()
                    <li class="hover:text-amber-500">
                        <a class="text-xl" href="{{route('users.index')}}">Usuários</a>
                    </li>
{{--                    <li class="hover:text-amber-500">--}}
{{--                        <a class="text-xl" href="{{route('upload.form')}}">Upload</a>--}}
{{--                    </li>--}}
                    <li class="hover:text-amber-500">
                        <a class="text-xl" href="{{route('moradores.index')}}">Moradores</a>
                    </li>
                    <li class="hover:text-amber-500">
                        <a class="text-xl" href="{{route('unidades.index')}}">Unidades</a>
                    </li>
                @endauth
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
