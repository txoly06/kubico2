@extends('layouts.app')

@section('title', 'Editar Imóvel')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-icon btn-outline-secondary rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="h2 mb-0">Editar Imóvel</h1>
            </div>

            <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')

                <div class="row g-4">
                    <!-- Seção Principal -->
                    <div class="col-lg-8">
                        <div class="form-floating mb-4">
                            <input type="text" name="title" id="title" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $property->title) }}"
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
                                      placeholder="Descrição detalhada" required>{{ old('description', $property->description) }}</textarea>
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
                                           value="{{ old('price', $property->price) }}"
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
                                        <option value="Aluguer" @selected(old('type', $property->type) == 'Aluguer')>Aluguel</option>
                                        <option value="Venda" @selected(old('type', $property->type) == 'Venda')>Venda</option>
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
                                   value="{{ old('address', $property->address) }}"
                                   placeholder="Endereço completo" required>
                            <label for="address">Endereço Completo</label>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="bedrooms" id="bedrooms"
                                           class="form-control form-control-lg @error('bedrooms') is-invalid @enderror"
                                           value="{{ old('bedrooms', $property->bedrooms) }}"
                                           min="1" required>
                                    <label for="bedrooms">Quartos</label>
                                    @error('bedrooms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="bathrooms" id="bathrooms"
                                           class="form-control form-control-lg @error('bathrooms') is-invalid @enderror"
                                           value="{{ old('bathrooms', $property->bathrooms) }}"
                                           min="1" required>
                                    <label for="bathrooms">Banheiros</label>
                                    @error('bathrooms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="area" id="area"
                                           class="form-control form-control-lg @error('area') is-invalid @enderror"
                                           value="{{ old('area', $property->area) }}"
                                           step="0.01" required>
                                    <label for="area">Área (m²)</label>
                                    @error('area')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seção de Imagens -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h3 class="h5 mb-4"><i class="bi bi-images me-2"></i>Gestão de Imagens</h3>
                                
                                <div class="file-upload-wrapper p-3 rounded-3 border-dashed mb-4">
                                    <input type="file" name="images[]" id="images" 
                                           class="form-control" 
                                           accept="image/*"
                                           multiple
                                           onchange="previewUpload(event)">
                                    <div class="text-center mt-3">
                                        <small class="text-muted d-block">Arraste imagens ou clique para selecionar</small>
                                    </div>
                                </div>

                                <div id="imagePreview" class="row g-2">
                                    @foreach($property->images as $image)
                                        <div class="col-6 col-md-4 position-relative">
                                            <div class="ratio ratio-1x1 rounded-3 overflow-hidden">
                                                <img src="{{ asset('images/properties/' . $image->image) }}" 
                                                     class="img-fluid object-fit-cover" 
                                                     alt="Imagem do imóvel">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-save me-2"></i>Salvar Alterações
                    </button>
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary btn-lg">
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

    .object-fit-cover {
        object-fit: cover;
    }

    .preview-image {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
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

    // Preview de novas imagens
    function previewUpload(event) {
        const preview = document.getElementById('imagePreview')
        preview.innerHTML = ''
        
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader()
            reader.onload = (e) => {
                const div = document.createElement('div')
                div.className = 'col-6 col-md-4 mb-3'
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