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
                            <th>Preço S/Desconto €</th>
                            <th>Desconto %</th>
                            <th>Valor €</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($codes as $code)
                            <tr>
                                <td>{{ $code[0] }}</td>
                                <td>{{ $code[1] }}</td>
                                <td>{{ $code[2] }}</td>
                                <td>{{ $code[3] }}</td>
                                <td>{{ $code[4] }}</td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
            <h4>Total: <span id="precoTotal">{{$code[5]}}</span>€</h4>
        </div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/budget.js') }}"></script>
@endsection
