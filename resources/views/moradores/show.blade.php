@extends('layouts.app')

@section('content')
    <div x-data="{ open: {{ request('modal') === 'true' ? 'true' : 'false' }} }">
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
                        <h1 class="text-3xl font-bold mb-5">Detalhes do Acolhido</h1>
                        <p class="text-lg mb-3"><strong>Nome:</strong> {{ $acolhido->nome }}</p>
                        <p class="text-lg mb-3"><strong>Data de Cadastro:</strong> {{ $acolhido->data_cadastro }}</p>
                        <p class="text-lg mb-3"><strong>Unidade:</strong> {{ $acolhido->unidade }}</p>
                        <p class="text-lg mb-3"><strong>Sexo:</strong> {{ $acolhido->sexo }}</p>
                        <p class="text-lg mb-3"><strong>CPF:</strong> {{ $acolhido->cpf }}</p>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <a href="{{ route('moradores.index') }}"
                           class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Voltar
                        </a>
                        <a href="{{ route('moradores.edit', $acolhido->id) }}"
                           class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Editar
                        </a>
                        <button @click="open = false"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
