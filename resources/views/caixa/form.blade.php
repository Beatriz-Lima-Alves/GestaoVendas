<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <div class="t-20 text-bold">
                       {{ __("Compra Iniciada") }} - {{$cliente->nome}}
                   </div>

                    <form id="product-form" action="{{route('caixa.add', $cliente->id)}}" class="mt-4 text-black" method="post">
                        @csrf

                        <div class="grid grid-cols-3 gap-4">

                            <div class="mb-4">
                                <x-input-label for="qtd" :value="__('Quantidade')" class="text-black"/>
                                <x-text-input id="qtd" class="block mt-1 w-full text-black" type="text" name="qtd" :value="old('qtd')" required autofocus />
                                <x-input-error :messages="$errors->get('qtd')" class="mt-2 text-black" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="cod_produto" :value="__('Código do produto')" class="text-black"/>
                                <x-text-input id="cod_produto" disabled class="block mt-1 w-full text-black" type="text" name="cod_produto" :value="old('cod_produto')" required autofocus />
                                <x-input-error :messages="$errors->get('cod_produto')" class="mt-2 text-black" />

                                <div id="searchResults" class="mt-2 border rounded-lg shadow-md bg-white">
                                </div>

                            </div>


                            <x-text-input id="total_compra" disabled class="block mt-1 w-full text-black" type="text" name="total_compra" :value="$total" required autofocus />

                        </div>

                        <div class="flex justify-end mt-2">
                            <input type="submit" value="{{ __('Adicionar produto') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-purple-btn">
                        </div>
                    </form>

                    <div class="cart">
                        <h2>Resumo da compra</h2>
                        <table class="w-full">
                            <thead>
                            <tr>
{{--                                <th class="px-4 py-2">#</th>--}}
                                <th class="px-4 py-2">Item</th>
                                <th class="px-4 py-2">Quantidade</th>
                                <th class="px-4 py-2">Preço por unidade</th>
                                <th class="px-4 py-2">Total</th>
                            </tr>
                            </thead>
                            <tbody id="cart-items">
                            <!-- Aqui será inserido dinamicamente o conteúdo do carrinho -->
                            @foreach($itens as $i)

                                <tr>
{{--                                 <td class="border px-4 py-2">{{$i->id_produto}}</td>--}}
                                 <td class="border px-4 py-2">{{$i->nome}}</td>
                                 <td class="border px-4 py-2">{{$i->qtd}}</td>
                                 <td class="border px-4 py-2">R${{$i->valor_unidade}}</td>
                                 <td class="border px-4 py-2">R${{$i->valor_total}}</td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="container mx-auto mt-5">
                            <div class="flex justify-between items-center">
                                <!-- Cancel Purchase Form -->
                                <form action="{{ route('caixa.cancele') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                                    <input type="submit" value="{{ __('Cancelar compra') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                </form>

                                <!-- Finalize Purchase Button -->
                                <button type="button" class="mt-2 inline-flex items-center px-4 py-2 bg-green-sb border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-purple-btn" data-toggle="modal" data-target="#modalPagamento">
                                    Finalizar Compra
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPagamento" tabindex="-1" role="dialog" aria-labelledby="modalPagamentoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagamentoLabel">Formas de pagamento</h5>
                </div>
                <div class="modal-body">
                    <!-- Conteúdo do modal -->
                    <p class="mb-2"><b>Total da Compra:</b> R${{ $total }}</p>
                    <!-- Formulário para selecionar o tipo de pagamento -->
                    <form action="{{ route('caixa.finalize') }}" method="post">
                    @csrf
                    <!-- Campo oculto para o ID do cliente -->
                        <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                        <input type="hidden" name="total" value="{{ $total }}">
                        <div class="form-group mb-3"> <!-- Adicionando uma classe "mb-3" para adicionar margem inferior -->
                            <label for="tipo_pagamento"><b>Tipo de Pagamento</b></label>
                            <select class="form-control" id="tipo_pagamento" name="tipo_pagamento">
                                <option value="Cartão de Crédito">Cartão de Crédito</option>
                                <option value="Cartão de Débito">Cartão de Débito</option>
                                <option value="Dinheiro">Dinheiro</option>
                            </select>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-sb border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-purple-btn">Confirmar Pagamento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Adiciona um evento de digitação ao campo de entrada
        document.getElementById('cod_produto').addEventListener('input', function(event) {
            // Pega o valor digitado pelo usuário
            var codProduto = event.target.value;

            // Envia uma requisição AJAX para o servidor
            axios.post('/search/produtos', {
                cod_produto: codProduto
            })
                .then(function(response) {
                    // Manipula a resposta da requisição
                    var searchResultsDiv = document.getElementById('searchResults');
                    searchResultsDiv.innerHTML = ''; // Limpa os resultados anteriores

                    // Itera sobre os produtos retornados e exibe-os na div de resultados
                    response.data.forEach(function(produto) {
                        // Cria um elemento de âncora para permitir que o usuário clique no nome do produto
                        var produtoAnchor = document.createElement('a');
                        produtoAnchor.textContent = produto.nome;
                        produtoAnchor.href = '#'; // Define o link como "#" para que a página não role ao clicar no âncora

                        // Adiciona um evento de clique para selecionar o produto e fechar a exibição dos resultados
                        produtoAnchor.addEventListener('click', function(event) {
                            event.preventDefault(); // Impede o comportamento padrão do link
                            // Define o valor do campo de entrada para o código do produto selecionado
                            document.getElementById('cod_produto').value = produto.cod_produto;
                            // Fecha a exibição dos resultados
                            searchResultsDiv.innerHTML = '';
                        });

                        // Adiciona um evento de teclado para fechar a exibição dos resultados quando o usuário pressionar Enter
                        produtoAnchor.addEventListener('keydown', function(event) {
                            if (event.key === 'Enter') {
                                event.preventDefault(); // Impede o comportamento padrão da tecla Enter
                                // Define o valor do campo de entrada para o código do produto selecionado
                                document.getElementById('cod_produto').value = produto.cod_produto;
                                // Fecha a exibição dos resultados
                                searchResultsDiv.innerHTML = '';
                            }
                        });

                        // Cria um elemento para exibir o nome do produto
                        var produtoDiv = document.createElement('div');
                        produtoDiv.appendChild(produtoAnchor);

                        // Adiciona o nome do produto à div de resultados
                        searchResultsDiv.appendChild(produtoDiv);
                    });
                })
                .catch(function(error) {
                    console.error('Ocorreu um erro ao buscar os produtos:', error);
                });
        });

        // Adiciona um evento de entrada ao campo de quantidade
        document.getElementById('qtd').addEventListener('input', function(event) {
            var codProdutoInput = document.getElementById('cod_produto');
            // Habilita ou desabilita o campo de entrada do código do produto baseado no preenchimento da quantidade
            codProdutoInput.disabled = event.target.value.trim() === '';
        });

        // Adiciona um evento de clique ao documento inteiro
        document.addEventListener('click', function(event) {
            // Verifica se o clique ocorreu dentro ou fora da área de resultados da pesquisa
            var isClickInsideSearchResults = event.target.closest('#searchResults');
            var searchResultsDiv = document.getElementById('searchResults');

            // Se o clique não ocorreu dentro da área de resultados da pesquisa
            if (!isClickInsideSearchResults) {
                // Oculta os resultados da pesquisa
                searchResultsDiv.innerHTML = '';
            }
        });
    </script>


</x-app-layout>
