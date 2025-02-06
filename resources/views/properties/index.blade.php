@extends('layouts.app')

@section('title', 'Imóveis Disponíveis')

@section('content')
    <h1 class="mb-4">Encontre o Imóvel dos Seus Sonhos</h1>

    <!-- Mensagens de Sucesso -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulário de Pesquisa -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Buscar por título ou endereço" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="">Tipo</option>
                <option value="Aluguel" @if(request('type') == 'Aluguel') selected @endif>Aluguel</option>
                <option value="Venda" @if(request('type') == 'Venda') selected @endif>Venda</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
    </form>

    <!-- Lista de Imóveis -->
    <div class="row">
        @forelse($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/properties/' . ($property->image ?? 'default.jpg')) }}" class="card-img-top" alt="Imagem do Imóvel">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text">{{ Str::limit($property->description, 80) }}</p>
                        <p><strong>Preço:</strong> AOA {{ number_format($property->price, 2, ',', '.') }}</p>
                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-outline-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Nenhum imóvel encontrado.</p>
        @endforelse
    </div>

    <!-- Paginação -->
    {{ $properties->links() }}
@endsection
