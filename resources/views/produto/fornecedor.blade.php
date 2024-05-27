<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="linha">
                        <p>{{ __("Fornecedores") }}/ <a href="<?php echo e(route('produto.index')); ?>" class="a-color-sub">Produtos</a></p>
                        <a href="<?php echo e(route('fornecedor.form')); ?>">
                            <button class="botao" title="Cadastrar um novo fornecedor"><i class="fa-solid fa-plus"></i></button>
                        </a>
                    </div>
                    <form action="{{ route('fornecedor.index') }}" method="GET" class="mb-4">
                        <input type="text" name="busca" placeholder="Buscar por nome" class="border rounded px-4 py-2" value="{{ request('busca') }}">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Buscar</button>
                    </form>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fornecedors as $f)
                                <tr>
                                    <td>{{ $f->id }}</td>
                                    <td>{{ $f->nome }}</td>
                                    <td>@if ($f->status == 0)
                                            Ativo
                                        @else
                                            Inativo
                                        @endif</td>
                                    <td>
                                        <div class="flex">
                                            @if ($f->status == 0)
                                            <a href="{{route('fornecedor.edit', $f->id)}}" style="margin-right: 10%" title="Editar o fornecedor"> <i class="fa-solid fa-pen-to-square"></i> </a>

                                            <form method="POST" action="{{ route('fornecedor.delete', $f->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" style="margin-left: 3%; color:red" title="Inativar o fornecedor"><i class="fa-solid fa-trash"></i></button>
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
