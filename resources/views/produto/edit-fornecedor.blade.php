<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                        <p class="t-20">{{ __("Editar o Fornecedor - ") }} {{$fornecedor->nome}}</p>
                    </div>
                    <hr style="margin-bottom: 20px;">
                    <form action="{{route('fornecedor.update', $fornecedor->id)}}" class="text-black" method="post">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="nome" :value="__('Nome')"  class="text-black"/>
                            <x-text-input id="nome" class="block mt-1 w-full text-black" type="text" name="nome" value="{{$fornecedor->nome}}" required autofocus />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2 text-black" />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center justify-end">
                                <a href="<?php echo e(route('fornecedor.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
