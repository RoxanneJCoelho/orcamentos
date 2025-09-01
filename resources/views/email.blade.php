@extends('layouts.master')
@section('title', 'OrçamentosJá - Orçamento')
@section('content')

<p>Caro/a {{ $cliente }},</p>

<p>Obrigado por escolher a {{ $empresa }}.</p>

<p>Em anexo o seu orçamento realizado com a {{ $empresa }} em formato PDF.</p>

<p>Segue-se também um link para agendar reunião com a {{ $empresa }} para discutir o orçamento:</p>

<p>
<a href="{{ $link }}">{{ $link }}</a>
</p>

<p>Com os melhores cumprimentos,</p>
<p>{{ $empresa }}</p>
<p>Telefone: {{ $telefone }}</p>
<p>Email: {{ $email }}</p>
