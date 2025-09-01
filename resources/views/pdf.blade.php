@extends('layouts.master')
@section('title', 'OrçamentosJá - Orçamento')
@section('content')
<body>
<h2>OrçamentosJá</h2>
<p>Orçamento nº: {{ $numero_orcamento }}</p>
<p>Data: {{ $data }}</p>

<p><b>De:</b><br>
{{ $empresa }} <br>
{{ $morada }} <br>
NIF: {{ $nif }} <br>
Tel: {{ $telefone }} <br>
Email: {{ $email }}
</p>

<p><b>Para:</b> {{ $cliente }}</p>

<table>
<thead>
<tr>
<th>Código</th>
<th>Descrição</th>
<th>Qtd</th>
<th>Preço p/unidade</th>
<th>Valor</th>
</tr>
</thead>
<tbody>
@php $total = 0; @endphp
@foreach($servicos as $s)
@php $valor = $s['qtd'] * $s['preco']; $total += $valor; @endphp
<tr>
<td>{{ $s['codigo'] }}</td>
<td>{{ $s['descricao'] }}</td>
<td>{{ $s['qtd'] }}</td>
<td>{{ number_format($s['preco'], 2, ',', '.') }}</td>
<td>{{ number_format($valor, 2, ',', '.') }}</td>
</tr>
@endforeach
</tbody>
</table>

<h3>Total Final: {{ number_format($total, 2, ',', '.') }} €</h3>
</body>
</html>
