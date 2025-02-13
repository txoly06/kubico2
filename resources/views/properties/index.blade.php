@extends('layouts.app')

@section('title', 'Imóveis Disponíveis')

@section('content')
<div class="container-fluid px-lg-5">
    <!-- Cabeçalho e Filtros -->
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-5 gap-4">
        <div>
            <h1 class="display-5 fw-bold mb-3">Encontre Seu Imóvel Ideal</h1>
            <p class="lead text-muted">{{ $properties->total() }} resultados encontrados</p>
        </div>
        
        <!-- Filtro Moderno -->
        <form method="GET" class="bg-light p-4 rounded-4 shadow-sm" style="min-width: 300px">
            <div class="input-group mb-3">
                <span class="input-group-text bg-transparent border-end-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </span>
                <input type="text" name="search" class="form-control border-start-0" 
                       placeholder="Localização, palavra-chave ou referência" value="{{ request('search') }}">
            </div>

            <select name="type" class="form-select mb-3" aria-label="Tipo de transação">
                <option value="">Todos os Tipos</option>
                <option value="Aluguel" @selected(request('type') == 'Aluguel')>Aluguel</option>
                <option value="Venda" @selected(request('type') == 'Venda')>Venda</option>
            </select>

            <button type="submit" class="btn btn-primary w-100">
                Aplicar Filtros
            </button>
        </form>
    </div>

    <!-- Listagem de Imóveis -->
    <div class="row g-4">
        @forelse($properties as $property)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 overflow-hidden border-0 shadow-hover">
                    <div class="position-relative">
                        @if($property->images->isNotEmpty())
                            <img src="{{ asset('images/properties/' . $property->images->first()->image) }}" 
                                 class="card-img-top property-image" 
                                 alt="{{ $property->title }}"
                                 loading="lazy">
                        @else
                            <div class="property-image-placeholder bg-gradient-primary"></div>
                        @endif
                        
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                {{ $property->type }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h3 class="h5 fw-bold mb-2">{{ $property->title }}</h3>
                        
                        <div class="d-flex gap-2 mb-3">
                            <small class="text-muted">
                                <i class="bi bi-geo-alt"></i> {{ $property->address }}
                            </small>
                        </div>

                        <p class="card-text text-truncate-3 mb-4">{{ $property->description }}</p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h4 text-primary mb-0">
                                    AOA {{ number_format($property->price, 2, ',', '.') }}
                                </span>
                            </div>
                            
                            <a href="{{ route('properties.show', $property->id) }}" 
                               class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2">
                               Ver Detalhes
                               <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info bg-light border-primary">
                    Nenhum imóvel encontrado com os critérios selecionados.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginação Estilizada -->
    @if($properties->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Navegação de resultados">
                {{ $properties->links('vendor.pagination.bootstrap-5-modified') }}
            </nav>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    :root {
        --property-image-height: 280px;
        --gradient-primary: linear-gradient(45deg, #f8f9fa, #e9ecef);
    }

    .property-image {
        height: var(--property-image-height);
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .property-image-placeholder {
        height: var(--property-image-height);
        background: var(--gradient-primary);
    }

    .shadow-hover {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .shadow-hover:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }

    .text-truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 4px;
    }
</style>
@endpush