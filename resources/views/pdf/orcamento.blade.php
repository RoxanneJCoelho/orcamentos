@extends('layouts.master')

@section('content')
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
                        </tr>
                    </thead>
                    <tbody>
                    <td></td>
                    <td>quantidade</td>
                    <td>precoSemDesconto€</td>
                    <td>desconto%</td>
                    <td>valorComDesconto€</td>
                    </tbody>
                </table>
            </div>
            <h4>Total: <span id="precoTotal">{{$code}}</span>€</h4>
        </div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/budget.js') }}"></script>
@endsection
