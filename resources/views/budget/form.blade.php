{{-- View do pedido de orçamento --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Orçamento')

@section('content')
<div class="container">
    <h2>Pedido de Orçamento</h2>

    <form id="orcamentoForm" method="POST" action="{{ route('budget.create') }}">
        @csrf
        <input type="hidden" name="tabelaSelecionadosJSON" id="tabelaSelecionadosJSON">
        <input type="hidden" name="data" value="" id="nameEmail">
        <input type="hidden" name="code" value="" id="objetoPost">

        {{-- Nome --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" aria-describedby="name" required>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" aria-describedby="email" required>
        </div>

        {{-- Filtro por Categoria --}}
        <div class="mb-3">
            <label for="categoryFilter" class="form-label">Filtrar por categoria</label>
            {{-- {{ dd($services) }} --}}
            <select id="categoryFilter" class="form-select">
                <option value="">Todas</option>
                @foreach($services as $categoryId => $categoryServices)
                <option value="{{ $categoryId }}">
                    {{ $categoryServices->first()->category_name }}
                </option>
                @endforeach
            </select>
        </div>


        {{-- Lista de Serviços --}}
        <div id="listaServicos">
            @foreach($services as $categoryId => $categoryServices)
            <div class="categoria mb-3" data-id="{{ $categoryId }}">
                <h4>{{ $categoryServices->first()->category_name }}</h4>
                @foreach($categoryServices as $service)
                <div class="servico d-flex justify-content-between align-items-center mb-2 p-2 border rounded"
                    data-id="{{ $service->id }}" data-preco="{{ $service->price }}"
                    data-desconto="{{ $service->discount }}">
                    {{ $service->description }}
                    <div class="input-group input-group-sm" style="width: 120px;">
                        <button type="button" class="btn btn-outline-primary btn-minus">
                            <img src="{{ asset('assets/images/budget/remove.png') }}" alt="Diminuir">
                        </button>
                        <input type="text" class="form-control text-center quantidade" value="0" min="0" step="1">
                        <button type="button" class="btn btn-outline-primary btn-plus">
                            <img src="{{ asset('assets/images/budget/add.png') }}" alt="Aumentar">
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div id="barraTotal" class="mt-4 mb-5 p-3 bg-light border rounded">
            <h5>Serviços Selecionados</h5>
            <div class="table-responsive">
                <table class="table table-sm table-hover" id="tabelaSelecionados">
                    <thead class="table-light">
                        <tr>
                            <th>Serviço</th>
                            <th>Quantidade</th>
                            <th>Preço S/Desconto</th>
                            <th>Desconto</th>
                            <th>Valor</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <h4>Total: <span id="precoTotal">0.00</span>€</h4>
                <button type="submit" class="btn btn-primary mt-2" id="btnDownloadPdf">Descarregar PDF</button>
        </button>

        <button type="submit" class="btn btn-primary mt-2" id="btnEnviarEmail">Enviar Orçamento por Email</button>
        </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/budget.js') }}"></script>
@endsection
