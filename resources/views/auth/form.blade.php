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
        <div id="listaServicos">
            @foreach($categorias as $categoria)
            <div class="categoria" data-id="{{ $categoria['id'] }}">
                <h4>{{ $categoria['name'] }}</h4>
                @foreach($categoria['servicos'] as $servico)
                <div class="servico" data-id="{{ $servico['id'] }}" data-preco="{{ $servico['price'] }}">
                    {{ $servico['name'] }} - €{{ number_format($servico['price'], 2) }}
                    <button type="button" class="btn btn-sm btn-primary addServico">Adicionar</button>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

        {{-- Barra de Total --}}
        <div id="barraTotal" class="mt-4 p-3 bg-light border rounded d-none">
            <h5>Serviços Selecionados</h5>
            <ul id="listaSelecionados"></ul>
            <h4>Total: €<span id="precoTotal">0.00</span></h4>
            <button type="submit" class="btn btn-success">Finalizar Orçamento</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/budget.js') }}"></script>
@endsection
