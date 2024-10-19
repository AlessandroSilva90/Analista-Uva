<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sua Conta') }}
        </h2>
    </x-slot>

    <div class="content flex  mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{ route('carrinho.index') }}">Carrinho de Compras</a>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->check() && auth()->user()->is_admin)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <a href="{{ route('produtos.index') }}">Cadastrar Produtos</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <a href="{{ route('carrinho.index') }}">Cadastrar Categorias</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif
    </div>
</x-app-layout>
