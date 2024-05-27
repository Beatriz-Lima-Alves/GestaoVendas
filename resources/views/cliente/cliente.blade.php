<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                            <p class="start">{{ __("Cliente") }}</p>
                            <div class="end">
                                <a href="{{ route('cliente.form') }}" class="botao" title="Cadastrar um novo cliente"><i class="fa-solid fa-plus"></i></a>
                            </div>

                    </div>
                    <form action="{{ route('cliente.index') }}" method="GET" class="mb-4">
                        <input type="text" name="busca" id="cpf" placeholder="Buscar por CPF" class="border rounded px-4 py-2" value="{{ request('busca') }}">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Buscar</button>
                    </form>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Dados do Cliente</th>
                                <th>Endereço</th>
                                <th>Contato</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $c)
                                <tr>
                                    <td>{{$c->id}}</td>
                                    <td>
                                        <strong>Nome:</strong> {{$c->nome}} <br>
                                        <strong>CPF:</strong> {{$c->cpf}}
                                    </td>
                                    <td>
                                        <strong>Logradouro:</strong> {{$c->logradouro}} <br>
                                        <strong>Número:</strong> {{$c->numero}} <br>
                                        <strong>Complemento:</strong> {{$c->complemento}} <br>
                                        <strong>Bairro:</strong> {{$c->bairro}} <br>
                                        <strong>Cidade:</strong> {{$c->localidade}} <br>
                                        <strong>Estado:</strong> {{$c->uf}}
                                    </td>
                                    <td>
                                        <strong>Telefone:</strong> {{$c->telefone}}
                                    </td>
                                    <td>
                                        <a href="{{route('cliente.edit', $c->id)}}" style="margin-right: 10%" title="Editar o fornecedor"> <i class="fa-solid fa-pen-to-square"></i> </a>
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
    <script src="https://cdn.jsdelivr.net/npm/imask"></script>
    <script>
        var cpfMask = IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</x-app-layout>
