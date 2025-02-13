@extends('layouts.app')

@section('title', 'Contato - KUBICO')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h1 class="mb-0">Fale Conosco</h1>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <h2 class="h4">Informações de Contato</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">📍 <strong>Endereço:</strong> Talatona, Luanda, Angola</li>
                        <li class="mb-3">📞 <strong>Telefone:</strong> +244 923 456 789</li>
                        <li class="mb-3">✉️ <strong>Email:</strong> contato@kubico.co.ao</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h2 class="h4">Horário de Atendimento</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">⏰ Seg-Sex: 08:00 - 18:00</li>
                        <li class="mb-3">⏰ Sábado: 09:00 - 13:00</li>
                        <li class="mb-3">⛪ Domingo: Fechado</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection