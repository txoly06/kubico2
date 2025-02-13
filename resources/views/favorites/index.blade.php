@extends('layouts.app')

@section('title', 'Meus Favoritos')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="h2 mb-0">Meus Imóveis Favoritos</h1>
                <a href="{{ route('properties.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-house-door me-2"></i>Explorar Imóveis
                </a>
            </div>

            @if($favorites->count())
                <div class="row g-4">
                    @foreach($favorites as $property)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('images/properties/' . ($property->image ?? 'default.jpg')) }}" 
                                         class="card-img-top object-fit-cover" 
                                         alt="{{ $property->title }}">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $property->title }}</h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit($property->description, 80) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-tag me-1"></i>
                                            R$ {{ number_format($property->price, 2, ',', '.') }}
                                        </span>
                                        <span class="text-muted small">
                                            <i class="bi bi-heart-fill text-danger"></i> 
                                            {{ $property->favoritedBy->count() }}
                                        </span>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('properties.show', $property->id) }}" 
                                           class="btn btn-outline-primary">
                                            <i class="bi bi-eye me-2"></i>Ver Detalhes
                                        </a>
                                        <form action="{{ route('favorites.destroy', $property->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger w-100"
                                                    onclick="return confirm('Remover dos favoritos?')">
                                                <i class="bi bi-trash me-2"></i>Remover
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-5">
                    {{ $favorites->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-heartbreak display-4 text-muted"></i>
                        <h3 class="h5 mt-4">Nenhum imóvel favoritado</h3>
                        <p class="text-muted mb-4">Comece explorando nosso catálogo de imóveis</p>
                        <a href="{{ route('properties.index') }}" class="btn btn-primary">
                            <i class="bi bi-house-door me-2"></i>Ver Imóveis
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .empty-state {
        max-width: 500px;
        margin: 0 auto;
    }
</style>
@endpush
@endsection