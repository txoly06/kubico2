<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('properties.index') }}">Imobiliária Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                    </li>
                @endguest
                    
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                     {{ Auth::user()->name }}
                        </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('create') }}">Cadastrar Imovel</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                    <li><a class="dropdown-item" href="{{ route('favorites.index') }}">Meus Favoritos</a></li>
            @role('admin')
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Painel Administrativo</a></li>
            @endrole
                    <li><hr class="dropdown-divider"></li>
                    <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">Sair</button>
                </form>
            </li>
        </ul>
    </li>
@endauth
                
            </ul>
        </div>
    </div>
</nav>
