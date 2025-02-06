@extends('layouts.app')

@section('title', 'Painel Administrativo')

@section('content')
    <div class="container">
        <h1 class="mb-4">Painel Administrativo</h1>

        <!-- Estatísticas Gerais -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Usuários Registrados</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalUsers }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Imóveis Cadastrados</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalProperties }}</h5>
                    </div>
                </div>
            </div>
            <!-- Outros cartões com estatísticas -->
        </div>

        <!-- Gráfico de Imóveis por Tipo -->
        <div class="mb-4">
            <h3>Imóveis por Tipo</h3>
            <canvas id="propertiesChart"></canvas>
        </div>

        <!-- Imóveis Mais Favoritados -->
        <div class="mb-4">
            <h3>Imóveis Mais Favoritados</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Favoritos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mostFavoritedProperties as $property)
                        <tr>
                            <td>{{ $property->title }}</td>
                            <td>{{ $property->favorited_by_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Você pode adicionar mais seções conforme necessário -->
    </div>

    <!-- Scripts para gráficos (utilizando Chart.js, por exemplo) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('propertiesChart').getContext('2d');
        const propertiesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($propertiesByType->pluck('type')) !!},
                datasets: [{
                    data: {!! json_encode($propertiesByType->pluck('total')) !!},
                    backgroundColor: ['#007bff', '#28a745'],
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>
@endsection
