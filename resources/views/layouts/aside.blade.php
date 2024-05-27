<!-- resources/views/sidebar.blade.php -->

<aside class="sidebar">
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('produto.index') }}">Catálogo</a></li>
        <li><a href="{{ route('estoque.index') }}">Estoque</a></li>
        <li><a href="{{ route('cliente.index') }}">Clientes</a></li>
        <li><a href="{{ route('caixa.index') }}">Caixa</a></li>
        <li><a href="{{ route('vendas.index') }}">Vendas</a></li>
        <li><a href="{{ route('funcionario.index') }}">Funcionários</a></li>
        <li><a href="{{ route('profile.edit') }}">Perfil</a></li>
        <li class="logout-btn"><!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Sair') }}
                </x-dropdown-link>
            </form></li>
{{--        <li><a href="{{ route('settings') }}">Configurações</a></li>--}}
        <!-- Adicione mais itens conforme necessário -->
    </ul>
</aside>
