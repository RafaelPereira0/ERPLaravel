<nav id="sidebar" class="d-flex flex-column">
    <div class="px-3 mb-3">
        <h4>Sistema ERP</h4>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-3">
            <a href="{{route('dashboard')}}" class="nav-link text-white">
                Dashboard
            </a>
        </li>
        <li class="nav-item d-flex align-items-center mb-3">
                    <span class="nav-link disabled text-white">Pessoas:</span>
                    <a class="btn btn-outline-light btn-sm " href="{{ route('admin.index') }}">
                        Admin
                    </a>
                    <a class="btn btn-outline-light btn-sm" href="{{route('clientes.index')}}">Cliente</a>
        </li>

        <li class="nav-item mb-3">
            <a href="{{route('fornecedores.index')}}" class="nav-link text-white">
                Fornecedores
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{route('produtos.index')}}" class="nav-link text-white">
                Produtos
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{route('movimentacoes.index')}}" class="nav-link text-white">
                Movimentações
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{route('estoque.index')}}" class="nav-link text-white">
                Estoque
            </a>
        </li>
    </ul>

    <div class="mt-10">
        @auth
            <div class="mt-10 text-white">
                Olá, <strong>{{ Auth::user()?->name }}</strong>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Sair</button>
            </form>
        {{-- @else
            <a href="{{ route('login') }}" class="btn btn-light w-100 mb-2">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light w-100">Registrar</a> --}}
        @endauth
    </div>
</nav>
