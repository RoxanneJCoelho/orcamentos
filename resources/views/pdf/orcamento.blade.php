<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Orçamento</title>

    @php
        $css = file_get_contents(public_path('assets/css/pdf.css'));
    @endphp
    <style>
        {!! $css !!}
    </style>

</head>

<body>
    <div class ="header client">
        <strong> Dados do Cliente</strong><br>
        <span>Nome: {{ $name }}</span><br>
        <span>Email: {{ $email }}</span><br>
    </div>

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
        <h4>Total: <span id="precoTotal">{{ $code[5] }}</span>€</h4>
        {{-- <h1>{{$name}}</h1>
        <h2>{{$email}}</h2> --}}
    </div>

    <div class="footer">
        Orçamento gerado a: {{ date('d/m/Y H:i') }}
        <br>Válido por 30 dias
    </div>
</body>

</html>
