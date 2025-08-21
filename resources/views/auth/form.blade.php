@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Pedido de Orçamento</h2>

    <form id="orcamentoForm" method="POST" action="{{ route('form.store') }}">
        @csrf

        {{-- Nome --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" required pattern="[A-Za-zÀ-ÿ\s]+">
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        {{-- Filtro por Categoria --}}
        <div class="mb-3">
            <label for="categoriaFiltro" class="form-label">Filtrar por Categoria</label>
            <select id="categoriaFiltro" class="form-select">
                <option value="">Todas</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria['id'] }}">{{ $categoria['name'] }}</option>
                @endforeach
            </select>
        </div>

        {{-- Lista de Serviços --}}
        <div id="listaServicos" class="mb-4">
            @foreach($categorias as $categoria)
            <div class="categoria mb-3" data-id="{{ $categoria['id'] }}">
                <h4 class="mb-2">{{ $categoria['name'] }}</h4>
                @foreach($categoria['servicos'] as $servico)
                <div class="servico d-flex justify-content-between align-items-center mb-2 p-2 border rounded"
                    data-id="{{ $servico['id'] }}" data-preco="{{ $servico['price'] }}">
                    <div class="flex-grow-1 fw-semibold">
                        {{ $servico['name'] }} - €{{ number_format($servico['price'], 2) }}
                    </div>
                    <div class="input-group input-group-sm" style="width: 120px;">
                        <button type="button" class="btn btn-outline-primary btn-minus">➖</button>
                        <input type="text" class="form-control text-center quantidade" value="0" readonly>
                        <button type="button" class="btn btn-outline-primary btn-plus">➕</button>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

        {{-- Barra de Total --}}
        <div id="barraTotal" class="mt-4 p-3 bg-light border rounded">
            <h5 class="mb-3">Serviços Selecionados</h5>
            <div class="table-responsive">
                <table class="table table-sm table-hover" id="tabelaSelecionados">
                    <thead class="table-light">
                        <tr>
                            <th>Serviço</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <h4>Total: €<span id="precoTotal">0.00</span></h4>
            <button type="submit" class="btn btn-success mt-2">Finalizar Orçamento</button>
        </div>
        @endsection

        @section('scripts')
        <script src="{{ asset('assets/js/budget.js') }}"></script>
        @endsection
