@extends('layouts.app')

@section('content')
    <div x-data="{ open: {{ request('modal') === 'edit' ? 'true' : 'false' }} }">
        <!-- O modal -->
        <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h1 class="text-3xl font-bold mb-5">Editar Acolhido</h1>
                        <form action="{{ route('moradores.update', $acolhido->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                                <input type="text" name="nome" value="{{ old('nome', $acolhido->nome) }}" required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Data de Cadastro:</label>
                                <input type="text" name="data_cadastro"
                                       value="{{ old('data_cadastro', $acolhido->data_cadastro) }}"
                                       required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Unidade:</label>
                                <input type="text" name="unidade" value="{{ old('unidade', $acolhido->unidade) }}"
                                       required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Sexo:</label>
                                <input type="text" name="sexo" value="{{ old('sexo', $acolhido->sexo) }}" required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                                <input type="text" name="cpf" value="{{ old('cpf', $acolhido->cpf) }}" required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- Adicione outros campos conforme necessário -->
                            <div class="flex space-x-4">
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Salvar
                                </button>
                                <a href="{{ route('moradores.index') }}"
                                   class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
