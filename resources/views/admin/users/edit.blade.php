@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-icon btn-outline-secondary rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="h2 mb-0"><i class="bi bi-person-gear me-2"></i>Editar Usuário</h1>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="name" id="name" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Nome completo" required>
                            <label for="name">Nome completo</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" name="email" id="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="Endereço de email" required>
                            <label for="email">Endereço de email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" name="password" id="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   placeholder="Nova senha (opcional)"
                                   autocomplete="new-password">
                            <label for="password">Nova Senha (opcional)</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted mt-1 d-block">Mínimo 8 caracteres</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="form-control form-control-lg" 
                                   placeholder="Confirme a nova senha"
                                   autocomplete="new-password">
                            <label for="password_confirmation">Confirme a Senha</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-save me-2"></i>Salvar Alterações
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-lg">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Validação do formulário
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush