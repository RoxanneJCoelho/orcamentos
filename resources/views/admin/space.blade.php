@extends('layouts.master')

@section('content')
<div class="container mt-5">

    <h2>Espaço Admin</h2>

    {{-- Categorias --}}
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Ver categorias</h3>
            <a href="{{ route('add.category') }}" class="btn btn-primary">Adicionar Categoria</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('edit.category', $category->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('delete.category', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tens a certeza que queres remover esta categoria?')">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Nenhuma categoria encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Serviços --}}
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Ver serviços</h3>
            <a href="{{ route('add.service') }}" class="btn btn-primary">Adicionar Serviço</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Desconto</th>
                        <th>Nome da Categoria</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->code }}</td>
                            <td>{{ $service->description }}</td>
                            <td>€{{ number_format($service->price, 2) }}</td>
                            <td>{{ $service->discount }}</td>
                            <td>{{ $service->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('edit.service', $service->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('delete.service', $service->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tens a certeza que queres remover este serviço?')">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Nenhum serviço encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
