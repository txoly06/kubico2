@extends('layouts.app')

@section('title', 'Cadastrar Imóvel')

@section('content')
    <h1>Cadastrar Novo Imóvel</h1>

    <!-- Exibir erros de validação -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Campos do Formulário -->
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço (AOA)</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <select name="type" class="form-select" id="type" required>
                <option value="">Selecione o tipo</option>
                <option value="Aluguel" {{ old('type') == 'Aluguel' ? 'selected' : '' }}>Aluguel</option>
                <option value="Venda" {{ old('type') == 'Venda' ? 'selected' : '' }}>Venda</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="bedrooms" class="form-label">Número de Quartos</label>
            <input type="number" name="quartos" class="form-control" id="quartos" value="{{ old('quartos') }}" required>
        </div>

        <div class="mb-3">
            <label for="bathrooms" class="form-label">Número de Banheiros</label>
            <input type="number" name="banheiros" class="form-control" id="banheiros" value="{{ old('banheiros') }}" required>
        </div>

        <div class="mb-3">
            <label for="area" class="form-label">Área (m²)</label>
            <input type="number" name="area" class="form-control" id="area" value="{{ old('area') }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagem do Imóvel</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection
