<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                        <p class="t-20">{{ __("Novo Produto") }}</p>
                    </div>
                    <hr style="margin-bottom: 20px;">
                    <form action="{{route('produto.store')}}" class="text-black" method="post">
                    @csrf

                        <div>
                            <x-input-label for="nome" :value="__('Nome')"  class="text-black"/>
                            <x-text-input id="nome" class="block mt-1 w-full text-black" type="text" name="nome" :value="old('nome')" required autofocus />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2 text-black" />
                        </div>

                        <div style="display: flex; margin-top: 1%">
                            <div style="margin-right: 20px;">
                                <x-input-label for="categoria" :value="__('Categoria')"  class="text-black"/>
                                <select id="categoria" name="categoria" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="eletronicos">Eletrônicos</option>
                                    <option value="roupas">Roupas</option>
                                    <option value="livros">Livros</option>
                                    <option value="alimentos">Alimentos</option>
                                </select>
                            </div>
                            <div  style="margin-right: 20px;">
                                <x-input-label for="id_fornecedor" :value="__('Fornecedor')"  class="text-black"/>
                                <select id="id_fornecedor" name="id_fornecedor" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="" disabled>Selecione um fornecedor</option>

                                    @foreach ($fornecedors as $fornecedor)
                                        <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div  style="margin-right: 20px;">
                                <x-input-label for="cod_produto" :value="__('Código do produto')"  class="text-black"/>
                                <x-text-input id="cod_produto" class="block mt-1 w-full text-black" type="text" name="cod_produto" :value="old('cod_produto')" required autofocus />
                                <x-input-error :messages="$errors->get('cod_produto')" class="mt-2 text-black" />
                            </div>

                            <div>
                                <x-input-label for="preco" :value="__('Preço')"  class="text-black"/>
                                <x-text-input id="preco" class="block mt-1 w-full text-black" type="number" name="preco" :value="old('preco')" step="0.01" required autofocus />
                                <x-input-error :messages="$errors->get('preco')" class="mt-2 text-black" />
                            </div>
                        </div>


                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center justify-end">
                                <a href="<?php echo e(route('produto.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Voltar
                                </a>

                            </div>
                            <div class="flex items-center justify-start">
                                <input type="submit" value="{{ __('Salvar') }}" class=" inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3 bg-purple-btn" style="background-color: #64B83E">

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
