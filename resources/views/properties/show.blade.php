@extends('layouts.app')

@section('title', $property->title)

@section('content')
<div class="container py-5">
    <nav aria-label="Navegação">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4" aria-label="Voltar à página anterior">
            <i class="bi bi-arrow-left me-2"></i>Voltar
        </a>
    </nav>

    <div class="row g-5 mt-2">
        <!-- Galeria de Imagens -->
        <div class="col-lg-8">
            <div class="row g-3" id="lightgallery">
                @forelse($property->images as $key => $image)
                    <div class="col-12 {{ $loop->first ? '' : 'col-md-6 col-xl-4' }}">
                        <a href="{{ asset('images/properties/' . $image->image) }}" 
                           class="gallery-item d-block rounded-4 overflow-hidden shadow-lg hover-zoom">
                            <img src="{{ asset('images/properties/' . $image->image) }}" 
                                 class="img-fluid w-100 {{ $loop->first ? 'ratio ratio-21x9' : 'ratio ratio-1x1' }}" 
                                 alt="Imagem do imóvel {{ $property->title }}"
                                 loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="ratio ratio-21x9 bg-light rounded-4">
                            <div class="d-flex align-items-center justify-content-center text-muted">
                                <i class="bi bi-image fs-1"></i>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Detalhes e Ações -->
        <div class="col-lg-4">
            <div class="sticky-top pt-3">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body">
                        <h1 class="h2 fw-bold mb-3">{{ $property->title }}</h1>
                        
                        <!-- Badges -->
                        <div class="d-flex gap-2 mb-4">
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                {{ $property->type }}
                            </span>
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                {{ $property->bedrooms }} <i class="bi bi-door-closed"></i>
                            </span>
                        </div>

                        <!-- Descrição -->
                        <article class="mb-4 text-secondary" style="text-align: justify;">
                            {{ $property->description }}
                        </article>

                        <!-- Especificações -->
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Preço</span>
                                <span class="fw-bold text-primary">
                                    AOA {{ number_format($property->price, 2, ',', '.') }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Área</span>
                                <span>{{ $property->area }} m²</span>
                            </li>
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Localização</span>
                                <span class="text-end">{{ $property->address }}</span>
                            </li>
                        </ul>

                        <!-- Ações -->
                        <div class="d-grid gap-3">
                            @auth
                                <form id="favoriteForm" method="POST" 
                                    action="{{ Auth::user()->favorites->contains($property->id) 
                                        ? route('favorites.destroy', $property->id) 
                                        : route('favorites.store', $property->id) }}">
                                    @csrf
                                    @if(Auth::user()->favorites->contains($property->id))
                                        @method('DELETE')
                                    @endif
                                    <button type="submit" class="btn btn-lg w-100 {{ Auth::user()->favorites->contains($property->id) 
                                        ? 'btn-warning' : 'btn-primary' }} rounded-pill">
                                        <i class="bi bi-heart{{ Auth::user()->favorites->contains($property->id) ? '-fill' : '' }}"></i>
                                        {{ Auth::user()->favorites->contains($property->id) ? 'Remover dos' : 'Adicionar aos' }} Favoritos
                                    </button>
                                </form>
                            @endauth

                            <button type="button" class="btn btn-success btn-lg rounded-pill" 
                                    data-bs-toggle="modal" data-bs-target="#contactModal">
                                <i class="bi bi-envelope-check"></i> Entrar em Contato
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Contato -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h2 class="modal-title fs-5" id="contactModalLabel">Contato do Anunciante</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4">
                <div class="d-flex flex-column gap-3">
                    <a href="mailto:{{ $property->user->email }}" class="btn btn-outline-primary py-3 rounded-pill">
                        <i class="bi bi-envelope me-2"></i>Enviar Email
                    </a>
                    <a href="tel:{{ $property->user->phone ?? '#' }}" class="btn btn-outline-success py-3 rounded-pill">
                        <i class="bi bi-telephone me-2"></i>Ligar Agora
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-zoom {
        transition: transform 0.3s ease;
    }
    .hover-zoom:hover {
        transform: scale(1.03);
    }
    .gallery-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0) 70%, rgba(0,0,0,0.3) 100%);
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializa LightGallery
        lightGallery(document.getElementById('lightgallery'), {
            selector: '.gallery-item',
            download: false,
            getCaptionFromTitleOrAlt: false
        });

        // AJAX para favoritos
        const favoriteForm = document.getElementById('favoriteForm');
        if(favoriteForm) {
            favoriteForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                try {
                    const response = await fetch(favoriteForm.action, {
                        method: favoriteForm.method,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if(response.ok) {
                        const result = await response.json();
                        location.reload(); // Atualiza para refletir mudanças
                    }
                } catch(error) {
                    console.error('Erro:', error);
                }
            });
        }
    });
</script>
@endpush