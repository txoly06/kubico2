<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <!-- Logo KUBICO -->
                    <div class="text-center mb-5">
                        <svg class="mx-auto mb-3" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="#4B49AC">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            <text x="50%" y="80%" text-anchor="middle" font-size="8" font-weight="bold" fill="#4B49AC">
                                KUBICO
                            </text>
                        </svg>
                        <h2 class="h3 mb-3 fw-bold text-dark">Acesse sua conta</h2>
                    </div>

                    <!-- Card de Login -->
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="card-body p-4 p-sm-5">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-medium">Email</label>
                                    <div class="input-group">
                                        <input 
                                            type="email" 
                                            class="form-control form-control-lg border-end-0 @error('email') is-invalid @enderror" 
                                            id="email"
                                            name="email"
                                            placeholder="email@kubico.com"
                                            required
                                            autofocus
                                        >
                                        <span class="input-group-text bg-transparent border-start-0">
                                            <i class="bi bi-envelope fs-5 text-secondary"></i>
                                        </span>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Senha -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-medium">Senha</label>
                                    <div class="input-group">
                                        <input 
                                            type="password" 
                                            class="form-control form-control-lg border-end-0 @error('password') is-invalid @enderror" 
                                            id="password"
                                            name="password"
                                            placeholder="••••••••"
                                            required
                                        >
                                        <span class="input-group-text bg-transparent border-start-0">
                                            <i class="bi bi-lock fs-5 text-secondary"></i>
                                        </span>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Lembrar e Recuperar Senha -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                        <label class="form-check-label small" for="remember_me">
                                            Lembrar-me
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="small text-decoration-none text-primary">
                                            Esqueceu a senha?
                                        </a>
                                    @endif
                                </div>

                                <!-- Botão de Login -->
                                <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                                </button>

                                <!-- Link para Registro -->
                                <div class="text-center small mt-4">
                                    <span class="text-muted">Novo no KUBICO? </span>
                                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                                        Crie sua conta
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>