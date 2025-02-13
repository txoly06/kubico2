<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Navegação principal">
    <div class="container-fluid">
        <a class="navbar-brand mx-auto" href="{{ route('properties.index') }}" aria-label="Ir para página inicial">
            <img src="{{ asset('favicon.ico') }}" alt="Logo KUBICO" width="30" height="30" class="d-inline-block align-text-top me-2">
            KUBICO
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" role="button" aria-label="Acessar conta">
                            <span aria-hidden="true">🔒</span> Entrar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" role="button" aria-label="Criar nova conta">
                            <span aria-hidden="true">📝</span> Registrar
                        </a>
                    </li>
                @endguest
                
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            👤 <span class="visually-hidden">Conta do usuário:</span> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('create') }}" aria-label="Cadastrar novo imóvel">
                                🏠 Cadastrar Imóvel
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('user.properties.index') }}" aria-label="Ver meus imóveis">
                                📋 Meus Imóveis
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}" aria-label="Editar perfil">
                                ✏️ Editar Perfil
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('favorites.index') }}" aria-label="Ver favoritos">
                                ❤️ Meus Favoritos
                            </a></li>          
                            <li><hr class="dropdown-divider"></li>
                            @role('admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}" aria-label="Painel administrativo">
                                    ⚙️ Painel Administrativo
                                </a></li>
                            @endrole
                            <li>
                                <form action="{{ route('logout') }}" method="POST" role="none">
                                    @csrf
                                    <button type="submit" class="dropdown-item" aria-label="Sair da conta">
                                        🚪 Sair
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>