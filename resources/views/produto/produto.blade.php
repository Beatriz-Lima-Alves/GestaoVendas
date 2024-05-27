<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                        <p>{{ __("Produtos") }}/ <a href="<?php echo e(route('fornecedor.index')); ?>" class="a-color-sub">Fornecedores</a></p>
                        <a href="<?php echo e(route('produto.form')); ?>">
                                <button class="botao" title="Cadastrar Produto"><i class="fa-solid fa-plus"></i></button>
                        </a>
                    </div>
                    <form action="{{ route('produto.index') }}" method="GET" class="mb-4">
                        <input type="text" name="busca" placeholder="Buscar por nome" class="border rounded px-4 py-2" value="{{ request('busca') }}">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Buscar</button>
                    </form>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Cod.</th>
                                <th>Categoria</th>
                                <th>Fornecedor</th>
                                <th>Preço</th>
                                <th>Qtd</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($produtos as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->nome}}</td>
                                <td>{{$p->cod_produto}}</td>
                                <td>{{$p->categoria}}</td>
                                <td>{{$p->nome_fornecedor}}</td>
                                <td>{{$p->preco}}</td>
                                <td>0</td>
                                <td>@if ($p->status == 0)
                                        Ativo
                                    @else
                                        Inativo
                                    @endif
                                </td>
                                <td>
                                    <div class="flex">
                                        @if ($p->status == 0)
                                            <a href="{{route('produto.edit', $p->id)}}" style="margin-right: 10%" title="Editar o produto"> <i class="fa-solid fa-pen-to-square"></i> </a>

                                            <form method="POST" action="{{route('produto.delete', $p->id)}}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" style="margin-left: 3%; color:red" title="Inativar o produto"><i class="fa-solid fa-trash"></i></button>
                                            </form>
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
</x-app-layout>
