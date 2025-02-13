@extends('layouts.app')

@section('title', 'Cadastrar Imóvel')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center mb-5">
                <a href="{{ route('properties.index') }}" class="btn btn-icon btn-outline-secondary rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="h2 mb-0">Cadastrar Novo Imóvel</h1>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-octagon me-2"></i>Verifique os erros no formulário
                </div>
            @endif

            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="row g-4">
                    <!-- Seção de Informações Básicas -->
                    <div class="col-lg-6">
                        <div class="form-floating mb-4">
                            <input type="text" name="title" id="title" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}"
                                   placeholder="Título do anúncio" required>
                            <label for="title">Título do Imóvel</label>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <textarea name="description" id="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      style="height: 150px"
                                      placeholder="Descrição detalhada" required>{{ old('description') }}</textarea>
                            <label for="description">Descrição Detalhada</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" name="price" id="price"
                                           class="form-control form-control-lg @error('price') is-invalid @enderror"
                                           value="{{ old('price') }}"
                                           step="0.01" required>
                                    <label for="price">Valor (AOA)</label>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="type" id="type" 
                                            class="form-select form-select-lg @error('type') is-invalid @enderror" required>
                                        <option value="">Selecione...</option>
                                        <option value="Aluguel" @selected(old('type') == 'Aluguel')>Aluguel</option>
                                        <option value="Venda" @selected(old('type') == 'Venda')>Venda</option>
                                    </select>
                                    <label for="type">Tipo de Transação</label>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="address" id="address"
                                   class="form-control form-control-lg @error('address') is-invalid @enderror"
                                   value="{{ old('address') }}"
                                   placeholder="Endereço completo" required>
                            <label for="address">Endereço Completo</label>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Seção de Características -->
                    <div class="col-lg-6">
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="quartos" id="quartos"
                                           class="form-control form-control-lg @error('quartos') is-invalid @enderror"
                                           value="{{ old('quartos') }}"
                                           min="1" required>
                                    <label for="quartos">Quartos</label>
                                    @error('quartos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="banheiros" id="banheiros"
                                           class="form-control form-control-lg @error('banheiros') is-invalid @enderror"
                                           value="{{ old('banheiros') }}"
                                           min="1" required>
                                    <label for="banheiros">Banheiros</label>
                                    @error('banheiros')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="area" id="area"
                                           class="form-control form-control-lg @error('area') is-invalid @enderror"
                                           value="{{ old('area') }}"
                                           step="0.01" required>
                                    <label for="area">Área (m²)</label>
                                    @error('area')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label mb-3">Imagens do Imóvel</label>
                            <div class="file-upload-wrapper border-dashed rounded-4 p-4 text-center">
                                <input type="file" name="images[]" id="images" 
                                       class="form-control" 
                                       accept="image/*"
                                       multiple
                                       onchange="previewUpload(event)">
                                <div class="mt-3">
                                    <p class="text-muted small mb-2">
                                        Arraste arquivos ou clique para selecionar<br>
                                        <span class="text-primary">Formatos suportados: JPG, PNG, WEBP</span>
                                    </p>
                                </div>
                                <div id="imagePreview" class="row g-2 mt-3"></div>
                            </div>
                            @error('images')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-house-add me-2"></i>Cadastrar Imóvel
                    </button>
                    <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary btn-lg">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .border-dashed {
        border: 2px dashed #dee2e6;
        transition: border-color 0.3s ease;
    }
    .file-upload-wrapper:hover .border-dashed {
        border-color: #0d6efd;
    }
    .preview-image {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
    }
    .preview-image img {
        height: 100px;
        object-fit: cover;
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

    // Preview de imagens
    function previewUpload(event) {
        const preview = document.getElementById('imagePreview')
        preview.innerHTML = ''
        
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader()
            reader.onload = (e) => {
                const div = document.createElement('div')
                div.className = 'col-4 col-md-3 mb-3'
                div.innerHTML = `
                    <div class="ratio ratio-1x1 preview-image">
                        <img src="${e.target.result}" class="img-fluid" alt="Preview">
                    </div>
                `
                preview.appendChild(div)
            }
            reader.readAsDataURL(file)
        })
    }
</script>
@endpush