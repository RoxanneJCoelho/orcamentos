@extends('layouts.master')

@section('title', 'OrçamentosJá - Página Inicial')

@section('content')
@auth
<h1>Bem vindo ao espaço admin</h1>
<a href="{{ route('show.admin') }}">
    <button type="button">ir para o espaço admin</button>
</a>
@endauth
@guest
<h1>Faça o seu orçamento connosco!</h1>
<a href="{{ route('show.form') }}">
    <button type="button">Pedir Orçamento</button>
</a>
@endguest

@endsection
