{{-- View do espaço admin (página principal) --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Espaço Admin')

@section('content')
<div class="container mt-5">

    <h2>Espaço Admin</h2>

    {{-- Categorias --}}
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Ver categorias</h3>
            <a href="{{ route('add.category') }}" class="btn bg-primary-subtle">Adicionar Categoria</a>
        </div>

        {{-- Mensagem de inserção de dados bem sucedida --}}
        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
        @endif

        {{-- Barra de pesquisa das categorias --}}
        <form action="">
            <input class="mb-3" type="text" value="{{request()->query('search')}}" name="search" id="search"
                placeholder="Digite a categoria a pesquisar">
            <button class="btn bg-primary-subtle">Pesquisar</button>
        </form>

        {{-- Tabela das categorias --}}
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
                        <td class="text-end">
                            <a href="{{ route('edit.category', $category->id) }}"
                                class="btn btn-sm btn-warning me-1">Editar</a>

                            {{-- Botão que abre o modal --}}
                            <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $category->id }}">
                                Remover
                            </button>

                            {{-- Modal --}}
                            <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Tem a certeza que quer remover a categoria <b>{{ $category->name
                                                }}</b>? Esta ação vai apagar não só a categoria, como todos os serviços
                                            a ela associados?
                                        </div>
                                        <div class="modal-footer">

                                            {{-- Botão cancelar --}}
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>

                                            {{-- Botão eliminar --}}
                                            <form action="{{ route('delete.category', $category->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Nenhuma categoria encontrada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Serviços --}}
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Ver serviços</h3>
            <a href="{{ route('add.service') }}" class="btn bg-primary-subtle">Adicionar Serviço</a>
        </div>

        {{-- Barra de pesquisa dos serviços --}}
        <form action="">
            <input class="mb-3" type="text" value="{{request()->query('search2')}}" name="search2" id="search2"
                placeholder="Digite o serviço a pesquisar">
            <button class="btn bg-primary-subtle">Pesquisar</button>
        </form>

        {{-- Tabela dos serviços --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Preço Unitário</th>
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
                        <td>{{ number_format($service->price, 2) }}€</td>
                        <td>{{ $service->discount }}%</td>
                        <td>{{ $service->name ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('edit.service', $service->id) }}"
                                class="btn btn-sm btn-warning me-1">Editar</a>

                            {{-- Botão que abre o modal --}}
                            <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal"
                                data-bs-target="#deleteServiceModal{{ $service->id }}">
                                Remover
                            </button>

                            {{-- Modal --}}
                            <div class="modal fade" id="deleteServiceModal{{ $service->id }}" tabindex="-1"
                                aria-labelledby="deleteServiceModalLabel{{ $service->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Tem a certeza que quer remover o serviço <b>{{ $service->description
                                                }}</b>?
                                        </div>
                                        <div class="modal-footer">

                                            {{-- Botão cancelar --}}
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>

                                            {{-- Botão eliminar --}}
                                            <form action="{{ route('delete.service', $service->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Nenhum serviço encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
