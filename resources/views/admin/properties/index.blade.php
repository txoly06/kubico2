@extends('layouts.app')

@section('title', 'Gerenciar Imóveis')

@section('content')
<div class="container-fluid px-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
                <h1 class="h3 mb-3 mb-md-0">Gerenciamento de Imóveis</h1>
                <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Novo Imóvel
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th class="text-end">Preço</th>
                            <th>Tipo</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td>
                                    <a href="{{ route('properties.show', $property->id) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($property->title, 40) }}
                                    </a>
                                </td>
                                <td class="text-end fw-semibold">
                                    AOA {{ number_format($property->price, 2, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $property->type }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('admin.properties.edit', $property->id) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip" 
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.properties.destroy', $property->id) }}" 
                                              method="POST"
                                              class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal"
                                                    data-bs-property-id="{{ $property->id }}">
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

            @if($properties->hasPages())
                <div class="mt-4">
                    {{ $properties->links() }}
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
                Tem certeza que deseja excluir este imóvel permanentemente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="confirmDeleteForm" action="{{route('admin.properties.destroy', $property->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Configuração do Modal
    const deleteModal = document.getElementById('deleteModal')
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const propertyId = button.getAttribute('data-bs-property-id')
        const form = document.getElementById('confirmDeleteForm')
        form.action = `/admin/properties/${propertyId}`
    })

    // Ativar tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
@endpush