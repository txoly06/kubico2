@extends('layouts.app')

@section('title', 'Política de Privacidade - KUBICO')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h1 class="mb-0">Política de Privacidade</h1>
        </div>

        <div class="card-body">
            <article>
                <h2 class="h4">1. Coleta de Dados</h2>
                <p>Coletamos apenas informações essenciais para a prestação de nossos serviços, incluindo:</p>
                <ul>
                    <li>Dados cadastrais básicos</li>
                    <li>Informações de transações</li>
                    <li>Dados de uso da plataforma</li>
                </ul>

                <h2 class="h4 mt-4">2. Proteção de Dados</h2>
                <p>Utilizamos tecnologia de criptografia SSL de 256 bits e seguimos as melhores práticas de segurança da informação.</p>

                <h2 class="h4 mt-4">3. Compartilhamento</h2>
                <p>Seus dados nunca são compartilhados com terceiros sem sua autorização explícita.</p>
            </article>
        </div>
    </div>
</div>
@endsection