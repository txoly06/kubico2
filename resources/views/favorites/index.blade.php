@extends('layouts.app')

@section('title', 'Meus Favoritos')

@section('content')
    <h1 class="mb-4">Meus Imóveis Favoritos</h1>

    @if($favorites->count())
        <div class="row">
            @foreach($favorites as $property)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/properties/' . ($property->image ?? 'default.jpg')) }}" class="card-img-top" alt="Imagem do Imóvel">
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text">{{ Str::limit($property->description, 80) }}</p>
                            <p><strong>Preço:</strong> R$ {{ number_format($property->price, 2, ',', '.') }}</p>
                            <a href="{{ route('properties.show', $property->id) }}" class="btn btn-outline-primary">Ver Detalhes</a>

                            <!-- Botão para remover dos favoritos -->
                            <form action="{{ route('favorites.destroy', $property->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-warning w-100">Remover dos Favoritos</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginação -->
        {{ $favorites->links() }}
    @else
        <p>Você ainda não favoritou nenhum imóvel.</p>
        <a href="{{ route('properties.index') }}" class="btn btn-primary">Ver Imóveis Disponíveis</a>
    @endif
@endsection
