<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                            <p class="justify-center">{{ __("Histórico do estoque") }}</p>
                    </div>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Qtd.</th>
                                <th>Tipo</th>
                                <th>Data da ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($estoqueEventos as $eE)
                            <tr>
                                <td>{{$eE->id}}</td>
                                <td>{{$eE->qtd}}</td>
                                <td>{{$eE->tipo}}</td>
                                <td>{{$eE->created_at->format('d/m/Y H:i:s')}}</td>

                            </tr>
                            @endforeach
                            <!-- Adicione mais linhas conforme necessário -->
                            </tbody>
                        </table>
                    </div>
                    <a href="{{route('estoque.index')}}" style="margin-right: 10%" class="botao btn btn-primary mt-4"> Voltar </a>

                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</x-app-layout>
