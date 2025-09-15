<h1>Orçamento</h1>
<table>
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Preço Sem Desconto</th>
            <th>Desconto</th>
            <th>Valor com Desconto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tabela as $item)
        <tr>
            <td>{{ $item['descricao'] }}</td>
            <td>{{ $item['quantidade'] }}</td>
            <td>{{ number_format($item['precoSemDesconto'], 2) }}€</td>
            <td>{{ $item['desconto'] }}%</td>
            <td>{{ number_format($item['valorComDesconto'], 2) }}€</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p>Total: {{ number_format($precoTotal, 2) }}€</p>

