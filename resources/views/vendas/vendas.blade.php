<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                        <p>{{ __("Vendas") }} </p>
                    </div>
                    <form action="{{ route('vendas.index') }}" method="GET" class="mb-4">
                        <input type="text" name="busca" placeholder="Buscar por codigo da venda" class="border rounded px-4 py-2" value="{{ request('busca') }}">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Buscar</button>
                    </form>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>Cod. venda</th>
                                <th>Total</th>
                                <th>Tipo de pagamento</th>
                                <th>Data da venda</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendas as $v)
                            <tr>
                                <td>{{$v->sequence_venda}}</td>
                                <td>R${{$v->total_venda}}</td>
                                <td>{{$v->tipo_pagamento}}</td>
                                <td>{{$v->created_at->format('d/m/Y H:i:s')}}</td>
                                <td>
                                    <a href="{{route('vendas.show', ['id'=>$v->sequence_venda])}}" style="margin-right: 10%" class="botaoSub"> Visualizar </a>
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
