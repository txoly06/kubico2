@extends('layouts.app')

@section('title', 'Painel Administrativo')

@section('content')
<div class="container-fluid px-4">
    <!-- Toast de Notificação -->
    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Sucesso</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5">
        <h1 class="h2 mb-3 mb-md-0">Painel Administrativo</h1>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>

    <!-- Filtros e Pesquisa -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.dashboard') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Pesquisar imóveis..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="type">
                            <option value="">Todos os tipos</option>
                            <option value="Aluguel" {{ request('type') == 'Aluguel' ? 'selected' : '' }}>Aluguel</option>
                            <option value="Venda" {{ request('type') == 'Venda' ? 'selected' : '' }}>Venda</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    

    
     

    <!-- Gráfico e Estatísticas -->
    <!-- <div class="row g-4 mt-2">
        <!-- Gráfico de Distribuição 
        <div class="col-xxl-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Distribuição de Imóveis por Tipo</h5>
                    <div class="dropdown">
                        <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Exportar Dados</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="propertiesChart" height="120"></canvas>
                </div>
            </div> -->
        </div>

    <div class="row g-4">
        
        <!-- Cards de Estatísticas (mantidos da versão anterior) -->
        <div class="col-xxl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary text-white rounded-3 p-3">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">{{ $totalUsers }}</h3>
                            <span class="text-muted">Usuários Registrados</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success text-white rounded-3 p-3">
                            <i class="bi bi-house-door fs-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">{{ $totalProperties }}</h3>
                            <span class="text-muted">Imóveis Cadastrados</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.properties.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

         <!-- Ações Rápidas -->
        <div class="col-xxl-4">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0">Ações Rápidas</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.properties.create') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle"></i> Novo Imóvel
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                        <i class="bi bi-person-plus"></i> Novo Usuário
                    </a>
                </div>
            </div>
        </div>
    </div>

        
        <!-- Tabela com Paginação -->
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Imóveis Mais Favoritados</h5>
                <div class="dropdown">
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="exportCsv">Exportar CSV</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <!-- Cabeçalho e Corpo da Tabela (mantido da versão anterior) -->
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th class="text-end">Favoritos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mostFavoritedProperties as $property)
                    <tr>
                        <td>
                            <a href="{{ route('properties.show', $property->id) }}" class="text-decoration-none">
                                {{ Str::limit($property->title, 40) }}
                            </a>
                        </td>
                        <td class="text-end">
                            <span class="badge bg-primary rounded-pill">{{ $property->favorited_by_count }}</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.properties.edit', $property->id) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip" 
                                   title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip" 
                                            title="Excluir"
                                            onclick="return confirm('Tem certeza que deseja excluir este imóvel?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            
            @if($mostFavoritedProperties->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Navegação de resultados">
                {{ $mostFavoritedProperties->links('vendor.pagination.bootstrap-5-modified') }}
            </nav>
        </div>
    @endif
        </div>
    </div>
</div>


<!-- Modal de Confirmação -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir este item permanentemente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar de Navegação -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Navegação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="nav flex-column">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a class="nav-link" href="{{ route('admin.properties.index') }}">
                <i class="bi bi-house-door me-2"></i> Imóveis
            </a>
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people me-2"></i> Usuários
            </a>
        </nav>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Scripts -->
<script>
    // Gráfico de Distribuição
    const ctx = document.getElementById('propertiesChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($propertiesByType->pluck('type')) !!},
            datasets: [{
                data: {!! json_encode($propertiesByType->pluck('total')) !!},
                backgroundColor: ['#4e79a7', '#59a14f', '#e15759'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 12,
                        padding: 20
                    }
                }
            },
            cutout: '60%'
        }
    });

    // Confirmação de Exclusão
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault()
            const form = this.closest('form')
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'))
            document.getElementById('deleteForm').action = form.action
            modal.show()
        })
    })

    // Exportar CSV
    document.getElementById('exportCsv').addEventListener('click', async () => {
        try {
            const response = await fetch("{{ route('admin.properties.export') }}")
            const blob = await response.blob()
            const url = window.URL.createObjectURL(blob)
            const a = document.createElement('a')
            a.href = url
            a.download = 'imoveis-favoritados.csv'
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
        } catch (error) {
            console.error('Erro na exportação:', error)
        }
    })
</script>
@endsection