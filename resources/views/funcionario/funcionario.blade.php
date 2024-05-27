<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="linha">
                            <p class="start">{{ __("Funcionários") }}</p>
                            <div class="end">
                                <a href="{{ route('register') }}" class="botao" title="Cadastrar um novo funcionário"><i class="fa-solid fa-plus"></i></a>
                            </div>

                    </div>
                    <form action="{{ route('funcionario.index') }}" method="GET" class="mb-4">
                        <input type="text" name="busca" placeholder="Buscar por codigo da venda" class="border rounded px-4 py-2" value="{{ request('busca') }}">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Buscar</button>
                    </form>
                    <div class="table-container">
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($funcionarios as $f)
                                <tr>
                                    <td>{{$f->id}}</td>
                                    <td>{{$f->name}}</td>
                                    <td>{{$f->email}}</td>
                                    <td>@if ($f->active == 1)
                                            Ativo
                                        @else
                                            Inativo
                                        @endif
                                    </td>
                                    @if ($f->active == 1)
                                        <td> <form method="POST" action="{{route('funcionario.delete', $f->id)}}">
                                                @csrf
                                                @method('put')
                                                <button type="submit" title="Deletar a conta do funcionário" class="ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    {{ __('Deletar conta') }}</button>
                                            </form>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</x-app-layout>
