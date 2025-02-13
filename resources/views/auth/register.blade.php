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
                        <h2 class="h3 mb-3 fw-bold text-dark">Crie sua conta</h2>
                    </div>

                    <!-- Card de Registro -->
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="card-body p-4 p-sm-5">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Nome Completo -->
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-medium">Nome completo</label>
                                    <div class="input-group">
                                        <input 
                                            type="text" 
                                            class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                            id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            placeholder="John Doe"
                                            required
                                            autofocus
                                        >
                                        <span class="input-group-text bg-transparent">
                                            <i class="bi bi-person fs-5 text-secondary"></i>
                                        </span>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-medium">Email</label>
                                    <div class="input-group">
                                        <input 
                                            type="email" 
                                            class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="email@kubico.com"
                                            required
                                        >
                                        <span class="input-group-text bg-transparent">
                                            <i class="bi bi-envelope fs-5 text-secondary"></i>
                                        </span>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Senha -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-medium">Senha</label>
                                        <div class="input-group">
                                            <input 
                                                type="password" 
                                                class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                                id="password"
                                                name="password"
                                                placeholder="••••••••"
                                                required
                                            >
                                            <span class="input-group-text bg-transparent">
                                                <i class="bi bi-lock fs-5 text-secondary"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label fw-medium">Confirme a Senha</label>
                                        <div class="input-group">
                                            <input 
                                                type="password" 
                                                class="form-control form-control-lg" 
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="••••••••"
                                                required
                                            >
                                            <span class="input-group-text bg-transparent">
                                                <i class="bi bi-shield-lock fs-5 text-secondary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botão de Registro -->
                                <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="bi bi-person-plus me-2"></i>Criar Conta
                                </button>

                                <!-- Link para Login -->
                                <div class="text-center small mt-4">
                                    <span class="text-muted">Já possui uma conta? </span>
                                    <a href="{{ route('login') }}" class="text-decoration-none text-primary">
                                        Faça login
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