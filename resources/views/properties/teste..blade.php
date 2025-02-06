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
        <!-- Outros campos semelhantes para description, price, etc. -->

        <div class="mb-3">
            <label for="image" class="form-label">Imagem do Imóvel</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection
