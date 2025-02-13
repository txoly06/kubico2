@extends('layouts.app')

@section('title', 'Adicionar Novo Usuário')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-icon btn-outline-secondary rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="h2 mb-0"><i class="bi bi-person-plus me-2"></i>Novo Usuário</h1>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="name" id="name" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
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
                                   placeholder="Senha" required
                                   pattern=".{8,}" 
                                   title="Mínimo de 8 caracteres">
                            <label for="password">Senha</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="password-strength mt-2">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="form-control form-control-lg" 
                                   placeholder="Confirme a senha" required>
                            <label for="password_confirmation">Confirme a senha</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-save me-2"></i>Cadastrar Usuário
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-lg" onclick="history.back()">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .password-strength .progress-bar {
        transition: width 0.3s ease;
    }
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    }
</style>
@endpush

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

    // Indicador de força da senha
    document.getElementById('password').addEventListener('input', function(e) {
        const strength = Math.min(this.value.length / 12 * 100, 100)
        const progressBar = document.querySelector('.password-strength .progress-bar')
        progressBar.style.width = strength + '%'
        progressBar.classList.toggle('bg-danger', strength < 40)
        progressBar.classList.toggle('bg-warning', strength >= 40 && strength < 80)
        progressBar.classList.toggle('bg-success', strength >= 80)
    })
</script>
@endpush