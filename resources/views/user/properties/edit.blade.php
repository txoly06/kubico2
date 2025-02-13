@extends('layouts.app')

@section('title', 'Editar Imóvel')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center mb-5">
                <a href="{{ route('user.properties.index') }}" class="btn btn-icon btn-outline-secondary rounded-circle me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="h2 mb-0">Editar Imóvel</h1>
            </div>

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4">
                    <i class="bi bi-exclamation-octagon me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                    </div>

                    <!-- Seção Lateral -->
                    <div class="col-lg-4">
                        <div class="form-floating mb-4">
                            <input type="number" name="price" id="price"
                                   class="form-control form-control-lg @error('price') is-invalid @enderror"
                                   value="{{ old('price', $property->price) }}"
                                   step="0.01" required>
                            <label for="price">Valor (AOA)</label>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <select name="status" id="status" 
                                    class="form-select form-select-lg @error('status') is-invalid @enderror" required>
                                <option value="Indisponivel" @selected(old('status', $property->status) == 'Indisponivel')>Indisponível</option>
                                <option value="Disponivel" @selected(old('status', $property->status) == 'Disponivel')>Disponível</option>
                            </select>
                            <label for="status">Status</label>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label mb-3">Imagem do Imóvel</label>
                            <div class="file-upload-wrapper border-dashed rounded-4 p-4 text-center">
                                @if($property->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/'.$property->image) }}" 
                                         class="img-fluid rounded-3 mb-2" 
                                         alt="Imagem atual"
                                         style="max-height: 200px">
                                </div>
                                @endif
                                <input type="file" name="image" id="image" 
                                       class="form-control" 
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                <div class="mt-3">
                                    <p class="text-muted small mb-2">
                                        Clique para selecionar nova imagem<br>
                                        <span class="text-primary">Formatos suportados: JPG, PNG, WEBP</span>
                                    </p>
                                </div>
                            </div>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-save me-2"></i>Salvar Alterações
                    </button>
                    <a href="{{ route('user.properties.index') }}" class="btn btn-outline-secondary btn-lg">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .border-dashed {
        border: 2px dashed #dee2e6;
        transition: border-color 0.3s ease;
    }
    .file-upload-wrapper:hover .border-dashed {
        border-color: #0d6efd;
    }
</style>
@endpush

@push('scripts')
<script>
    function previewImage(event) {
        const output = document.createElement('img');
        output.className = 'img-fluid rounded-3 mb-2';
        output.style.maxHeight = '200px';
        output.src = URL.createObjectURL(event.target.files[0]);
        event.target.parentNode.insertBefore(output, event.target);
    }
</script>
@endpush
@endsection