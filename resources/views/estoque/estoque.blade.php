<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                            <p class="start">{{ __("Estoque") }}</p>
                            <div class="end">
                                <button class="btn-red" title="Cadastrar saida de estoque" data-toggle="modal" data-target="#saidaModal"><i class="fas fa-minus"></i></button>
                                <button class="botao" title="Cadastrar entrada de estoque" data-toggle="modal" data-target="#entradaModal"><i class="fa-solid fa-plus"></i></button>
                            </div>

                    </div>
                    <form action="{{ route('estoque.index') }}" method="GET" class="mb-4">
                        <input type="text" name="busca" placeholder="Buscar por nome" class="border rounded px-4 py-2" value="{{ request('busca') }}">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Buscar</button>
                    </form>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>produto</th>
                                <th>Cod.</th>
                                <th>Quantidade</th>
                                <th>Fornecedor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($estoque as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->nome_produto}}</td>
                                <td>{{$p->cod_produto}}</td>
                                <td>{{$p->qtd}}</td>
                                <td>{{$p->nome_fornecedor}}</td>
                                <td>@if ($p->status == 0)
                                        Ativo
                                    @else
                                        Inativo
                                    @endif
                                </td>
                                <td>
                                    <div class="flex">
                                        @if ($p->status == 0)
                                            <a href="{{route('estoque.show', ['id'=>$p->id])}}" style="margin-right: 10%" class="botaoSub btn btn-primary"> Visualizar </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <!-- Adicione mais linhas conforme necessário -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Entrada-->
    <div class="modal fade" id="entradaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-center">
                    <h5 class="modal-title text-bold" id="exampleModalLabel">Adicionar entrada</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('estoque.store')}}" class="text-black" method="post">
                    @csrf
                        <!-- Campo Nome do Produto -->
                        <x-input-label for="id_produto" :value="__('Produto')"  class="text-black"/>
                        <select id="id_produto" name="id_produto" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="" disabled>Selecione um produto</option>

                            @foreach ($produtos as $p)
                                <option value="{{ $p->id }}">{{ $p->nome }}</option>
                            @endforeach
                        </select>

                        <div>
                            <x-input-label for="qtd" :value="__('Quantidade')"  class="text-black pt-4"/>
                            <x-text-input id="qtd" class="block mt-1 w-full text-black" type="number" name="qtd" :value="old('qtd')" step="0.01" required autofocus />
                            <x-input-error :messages="$errors->get('qtd')" class="mt-2 text-black" />
                        </div>
                        <!-- Botão de Envio -->
                        <input type="submit" value="{{ __('Cadastrar Entrada') }}" class="botao mt-4 btn btn-primary"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Saida-->
    <div class="modal fade" id="saidaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header justify-center">
                    <h5 class="modal-title text-bold" id="exampleModalLabel">Adicionar saída</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('estoque.storeMenos')}}" method="post">
                    @csrf
                        <!-- Campo Nome do Produto -->
                        <x-input-label for="id_produto" :value="__('Produto')"  class="text-black"/>
                        <select id="id_produto" name="id_produto" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="" disabled>Selecione um produto</option>

                            @foreach ($produtos as $p)
                                <option value="{{ $p->id }}">{{ $p->nome }}</option>
                            @endforeach
                        </select>

                        <div>
                            <x-input-label for="qtd" :value="__('Quantidade')"  class="text-black pt-4"/>
                            <x-text-input id="qtd" class="block mt-1 w-full text-black" type="number" name="qtd" :value="old('qtd')" step="0.01" required autofocus />
                            <x-input-error :messages="$errors->get('qtd')" class="mt-2 text-black" />
                        </div>
                        <!-- Botão de Envio -->
                        <input type="submit" value="{{ __('Cadastrar Saída') }}" class="botao mt-4 btn btn-primary"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</x-app-layout>
