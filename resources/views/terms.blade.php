@extends('layouts.app')

@section('title', 'Termos de Uso - KUBICO')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h1 class="mb-0">Termos de Uso</h1>
        </div>

        <div class="card-body">
            <article>
                <h2 class="h4">1. Aceitação dos Termos</h2>
                <p>Ao utilizar nossa plataforma, você concorda com:</p>
                <ul>
                    <li>Uso ético dos serviços</li>
                    <li>Veracidade das informações</li>
                    <li>Respeito às leis vigentes</li>
                </ul>

                <h2 class="h4 mt-4">2. Responsabilidades</h2>
                <p>A KUBICO atua como intermediária e não se responsabiliza por:</p>
                <ul>
                    <li>Conteúdo de anúncios</li>
                    <li>Transações entre partes</li>
                    <li>Documentação irregular</li>
                </ul>

                <h2 class="h4 mt-4">3. Alterações</h2>
                <p>Estes termos podem ser atualizados periodicamente. Alterações significativas serão notificadas por email.</p>
            </article>
        </div>
    </div>
</div>
@endsection