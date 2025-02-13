<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <!-- Card de Confirmação -->
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="card-body p-4 p-sm-5">
                            <!-- Mensagem de Segurança -->
                            <div class="alert alert-info mb-4">
                                <i class="bi bi-shield-lock me-2"></i>
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <!-- Senha -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <input 
                                            type="password" 
                                            class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                            id="password"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            placeholder="••••••••"
                                        >
                                        <span class="input-group-text bg-transparent">
                                            <i class="bi bi-lock fs-5 text-secondary"></i>
                                        </span>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Botões -->
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none text-primary small">
                                        <i class="bi bi-question-circle me-1"></i>
                                        {{ __('Forgot Password?') }}
                                    </a>
                                    
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-shield-check me-2"></i>
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>