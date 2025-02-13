@extends('layouts.app')

@section('title', 'Adicionar Novo Imóvel')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-5">
            <h1 class="h2 mb-4">Cadastrar Novo Imóvel</h1>
            
            <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="row g-4">
                    <!-- Seção de Informações Básicas -->
                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <input type="text" name="title" id="title" 
                                class="form-control form-control-lg" 
                                placeholder="Título do anúncio" required>
                            <label for="title">Título do Imóvel</label>
                            <div class="invalid-feedback">Por favor insira um título válido</div>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="number" name="price" id="price"
                                class="form-control form-control-lg"
                                placeholder="Preço" step="0.01" required>
                            <label for="price">Valor (AOA)</label>
                            <div class="invalid-feedback">Insira um valor válido</div>
                        </div>

                        <div class="form-floating mb-4">
                            <select name="type" id="type" 
                                class="form-select form-select-lg" required>
                                <option value="">Selecione...</option>
                                <option value="Aluguer">Aluguel</option>
                                <option value="Venda">Venda</option>
                            </select>
                            <label for="type">Tipo de Transação</label>
                            <div class="invalid-feedback">Selecione o tipo de transação</div>
                        </div>
                    </div>

                    <!-- Seção de Detalhes Técnicos -->
                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <input type="text" name="address" id="address"
                                class="form-control form-control-lg"
                                placeholder="Endereço completo" required>
                            <label for="address">Endereço Completo</label>
                            <div class="invalid-feedback">Insira um endereço válido</div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="bedrooms" id="bedrooms"
                                        class="form-control form-control-lg"
                                        placeholder="Quartos" min="1" required>
                                    <label for="bedrooms">Quartos</label>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="bathrooms" id="bathrooms"
                                        class="form-control form-control-lg"
                                        placeholder="Banheiros" min="1" required>
                                    <label for="bathrooms">Banheiros</label>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="area" id="area"
                                        class="form-control form-control-lg"
                                        placeholder="Área" step="0.01" required>
                                    <label for="area">Área (m²)</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-4">
                            <textarea name="description" id="description"
                                class="form-control" 
                                style="height: 120px"
                                placeholder="Descrição detalhada" required></textarea>
                            <label for="description">Descrição Detalhada</label>
                            <div class="invalid-feedback">Forneça uma descrição completa</div>
                        </div>
                    </div>

                    <!-- Upload de Imagens -->
                    <div class="col-12">
                        <div class="file-upload-wrapper p-4 rounded-4 border-dashed">
                            <input type="file" name="images[]" id="images" 
                                class="form-control form-control-lg" 
                                accept="image/*"
                                multiple
                                required
                                onchange="previewUpload(event)">
                            
                            <div class="mt-3 text-center">
                                <small class="text-muted d-block mb-2">Arraste arquivos ou clique para selecionar</small>
                                <span class="badge bg-primary">
                                    Formatos suportados: JPG, PNG, WEBP
                                </span>
                            </div>

                            <div id="imagePreview" class="row g-2 mt-3"></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                            <i class="bi bi-house-add me-2"></i>Cadastrar Imóvel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .file-upload-wrapper {
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
        background: rgba(13, 110, 253, 0.05);
    }

    .file-upload-wrapper:hover {
        border-color: #0d6efd;
        background: rgba(13, 110, 253, 0.1);
    }

    .preview-image {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
    }

    .preview-image img {
        height: 120px;
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

    // Drag and drop
    const dropArea = document.querySelector('.file-upload-wrapper')
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
    })

    function preventDefaults (e) {
        e.preventDefault()
        e.stopPropagation()
    }

    ;['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
    })

    function highlight(e) {
        dropArea.classList.add('dragover')
    }

    function unhighlight(e) {
        dropArea.classList.remove('dragover')
    }

    dropArea.addEventListener('drop', handleDrop, false)

    function handleDrop(e) {
        const dt = e.dataTransfer
        const files = dt.files
        document.getElementById('images').files = files
        previewUpload({ target: document.getElementById('images') })
    }
</script>
@endpush