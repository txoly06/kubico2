@extends('layouts.app')

@section('title', 'Gerenciar Usuários')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gerenciar Usuários</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Adicionar Novo Usuário</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
