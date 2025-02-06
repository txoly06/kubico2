@extends('layouts.app')

@section('title', $property->title)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset('images/properties/' . ($property->image ?? 'default.jpg')) }}" class="img-fluid" alt="Imagem do Imóvel">
        </div>
        <div class="col-md-4">
            <h2>{{ $property->title }}</h2>
            <p>{{ $property->description }}</p>
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Preço:</strong> AOA {{ number_format($property->price, 2, ',', '.') }}</li>
                <li class="list-group-item"><strong>Endereço:</strong> {{ $property->address }}</li>
                <li class="list-group-item"><strong>Tipo:</strong> {{ $property->type }}</li>
                <li class="list-group-item"><strong>Quartos:</strong> {{ $property->quartos }}</li>
                <li class="list-group-item"><strong>Banheiros:</strong> {{ $property->banheiros }}</li>
                <li class="list-group-item"><strong>Área:</strong> {{ $property->area }} m²</li>
            </ul>

            @auth
                @if(Auth::user()->favorites->contains($property->id))
                    <form action="{{ route('favorites.destroy', $property->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning w-100 mb-2">Remover dos Favoritos</button>
                    </form>
                @else
                    <form action="{{ route('favorites.store', $property->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary w-100 mb-2">Adicionar aos Favoritos</button>
                    </form>
                @endif
            @endauth

            <!-- Contato -->
            <a href="mailto:{{ $property->user->email }}" class="btn btn-success w-100">Entrar em Contato</a>
        </div>
    </div>
@endsection
