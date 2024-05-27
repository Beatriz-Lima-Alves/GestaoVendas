<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                        <p class="t-20">{{ __("Editar o Cliente") }}</p>
                    </div>
                    <hr style="margin-bottom: 20px;">
                    <form action="{{route('cliente.update', $cliente->id)}}" class="text-black" method="post">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nome" :value="__('Nome')" class="text-black"/>
                            <x-text-input id="nome" class="block mt-1 w-full text-black" type="text" name="nome" :value="$cliente->nome" required autofocus />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2 text-black" />
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div>
                                <x-input-label for="cpf" :value="__('CPF')" class="text-black"/>
                                <x-text-input id="cpf" class="block mt-1 w-full text-black" type="text" name="cpf" :value="$cliente->cpf" required />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2 text-black" />
                            </div>

                            <div>
                                <x-input-label for="telefone" :value="__('Telefone')" class="text-black"/>
                                <x-text-input id="telefone" class="block mt-1 w-full text-black" type="text" name="telefone" :value="$cliente->telefone" required />
                                <x-input-error :messages="$errors->get('telefone')" class="mt-2 text-black" />
                            </div>
                        </div>


                        <div class="grid grid-cols-3 gap-x-4">
                            <div>
                                <x-input-label for="cep" :value="__('CEP')" class="text-black"/>
                                <x-text-input id="cep" class="block mt-1 w-full text-black" type="text" name="cep" :value="$cliente->cep" required />
                                <x-input-error :messages="$errors->get('cep')" class="mt-2 text-black" />
                            </div>
                            <div>
                                <x-input-label for="logradouro" :value="__('Logradouro')" class="text-black"/>
                                <x-text-input id="logradouro" class="block mt-1 w-full text-black" type="text" name="logradouro" :value="$cliente->logradouro" required />
                                <x-input-error :messages="$errors->get('logradouro')" class="mt-2 text-black" />
                            </div>
                            <div>
                                <x-input-label for="numero" :value="__('Número')" class="text-black"/>
                                <x-text-input id="numero" class="block mt-1 w-full text-black" type="text" name="numero" :value="$cliente->numero" required />
                                <x-input-error :messages="$errors->get('numero')" class="mt-2 text-black" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div>
                                <x-input-label for="complemento" :value="__('Complemento')" class="text-black"/>
                                <x-text-input id="complemento" class="block mt-1 w-full text-black" type="text" name="complemento" :value="$cliente->complemento" />
                                <x-input-error :messages="$errors->get('complemento')" class="mt-2 text-black" />
                            </div>
                            <div>
                                <x-input-label for="bairro" :value="__('Bairro')" class="text-black"/>
                                <x-text-input id="bairro" class="block mt-1 w-full text-black" type="text" name="bairro" :value="$cliente->bairro" required />
                                <x-input-error :messages="$errors->get('bairro')" class="mt-2 text-black" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div>
                                <x-input-label for="localidade" :value="__('Localidade')" class="text-black"/>
                                <x-text-input id="localidade" class="block mt-1 w-full text-black" type="text" name="localidade" :value="$cliente->localidade" required />
                                <x-input-error :messages="$errors->get('localidade')" class="mt-2 text-black" />
                            </div>

                            <div>
                                <x-input-label for="uf" :value="__('UF')" class="text-black"/>
                                <x-text-input id="uf" class="block mt-1 w-full text-black" type="text" name="uf" :value="$cliente->uf" required />
                                <x-input-error :messages="$errors->get('uf')" class="mt-2 text-black" />
                            </div>
                        </div>



                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center justify-end">
                                <a href="<?php echo e(route('cliente.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
    <script src="https://cdn.jsdelivr.net/npm/imask"></script>

    <script>
        $(document).ready(function() {
            $('#cep').focusout(function() {
                console.log('entrou')
                var cep = $(this).val();
                $.ajax({
                    url: 'https://viacep.com.br/ws/'+cep+'/json/',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#logradouro').val(data.logradouro);
                        $('#complemento').val(data.complemento);
                        $('#bairro').val(data.bairro);
                        $('#localidade').val(data.localidade);
                        $('#uf').val(data.uf);
                        // Preencha outros campos de endereço conforme necessário
                        $("#numero").focus(); // Vamos incluir para que o Número seja focado automaticamente
                    },
                    error: function() {
                        alert('Erro ao buscar o endereço.');
                    }
                });
            });

        });
        var cpfMask = IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });
    </script>
</x-app-layout>
