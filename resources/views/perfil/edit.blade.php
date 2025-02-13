@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Cabeçalho -->
            <div class="d-flex align-items-center mb-5">
                <a href="{{ url()->previous() }}" class="btn btn-icon btn-outline-secondary rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h2 class="h3 mb-0">Configurações da Conta</h2>
            </div>

            <!-- Notificação -->
            @if(session('status') == 'profile-updated')
                <div class="alert alert-success d-flex align-items-center mb-4">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Perfil atualizado com sucesso!
                </div>
            @endif

            <!-- Card de Edição -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="name" class="form-label">Nome</label>
                            <div class="input-group">
                                <input type="text" 
                                       name="name" 
                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" 
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                <span class="input-group-text bg-transparent">
                                    <i class="bi bi-person"></i>
                                </span>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <input type="email" 
                                       name="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" 
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                <span class="input-group-text bg-transparent">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Alterar Senha</label>
                            <div class="input-group">
                                <input type="password" 
                                       name="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password"
                                       placeholder="Deixe em branco para manter">
                                <span class="input-group-text bg-transparent">
                                    <i class="bi bi-lock"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Mínimo 8 caracteres</small>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <div class="input-group">
                                <input type="password" 
                                       name="password_confirmation" 
                                       class="form-control form-control-lg" 
                                       id="password_confirmation">
                                <span class="input-group-text bg-transparent">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-save me-2"></i>Atualizar Perfil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card de Exclusão -->
            <div class="card border-0 shadow-sm border-danger">
                <div class="card-body p-4">
                    <h5 class="text-danger mb-3">
                        <i class="bi bi-exclamation-octagon me-2"></i>Zona de Risco
                    </h5>
                    
                    <form action="{{ route('profile.destroy') }}" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                class="btn btn-outline-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmDeleteModal">
                            <i class="bi bi-trash me-2"></i>Excluir Conta Permanentemente
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmação
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir sua conta permanentemente? Esta ação não pode ser desfeita!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="deleteForm" class="btn btn-danger">Confirmar Exclusão</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-border-danger {
        border: 1px solid #dc3545;
    }
    .input-group-text {
        border-left: none;
    }
    .form-control-lg {
        border-right: none;
    }
</style>
@endpush