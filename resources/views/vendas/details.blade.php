<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                            <div class="text-20">{{ __("Comprovante da venda")}}</div>

                        <ol class="border border-gray-400">
                            <!-- Na sua lista -->
                            <li class="cliente-info border border-gray-400"><b>Cliente:</b> {{$cliente->nome}} <strong>CPF:</strong> {{$cliente->cpf}} <strong>Telefone:</strong> {{$cliente->telefone}}</li>
                            <li class="cliente-info border border-gray-400"><b>CEP:</b> {{$cliente->cep}} <strong>Logradouro:</strong> {{$cliente->logradouro}} <strong>Número:</strong> {{$cliente->numero}}</li>
                            <li class="cliente-info border border-gray-400"><b>Complemento:</b> {{$cliente->complemento}} <strong>Bairro:</strong> {{$cliente->bairro}}</li>
                            <li class="cliente-info border border-gray-400"><b>Cidade:</b> {{$cliente->localidade}} <strong>UF:</strong> {{$cliente->uf}}</li>
                        </ol>

                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Qtd.</th>
                                <th>Produto</th>
                                <th>Preço por unidade</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($itensVendas as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->qtd}}</td>
                                <td>{{$v->nome_produto}}</td>
                                <td>{{$v->valor_unidade}}</td>
                                <td>{{$v->valor_total}}</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: end"><b>Total:</b></td>
                                <td>R${{$total}}</td>
                            </tr>
                            <!-- Adicione mais linhas conforme necessário -->
                            </tbody>
                        </table>
                    </div>
                    <a href="{{route('vendas.index')}}" style="margin-right: 10%" class="botao btn btn-primary mt-4"> Voltar </a>

                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</x-app-layout>
