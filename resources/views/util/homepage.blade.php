@extends('layouts.master')

@section('title', 'OrçamentosJá - Página Inicial')

@section('content')
<div class="d-flex flex-column flex-lg-row homepage-container min-vh-100 d-flex flex-wrap">

    <!-- Imagem à esquerda (desktop) / em cima (mobile) -->
    <div class="flex-md-fill homepage-image"></div>

    <!-- Texto à direita (desktop) / em baixo (mobile) -->
    <div class="flex-md-fill d-flex flex-column justify-content-start justify-content-lg-center align-items-center text-center p-4 homepage-text">
        @auth
            <h1 class="mb-3">Bem-vind@ ao espaço admin</h1>
            <a href="{{ route('show.admin') }}" class="btn bg-primary-subtle">Ir para o espaço admin</a>
        @endauth

        @guest
            <h1 class="mb-3">Faça o seu orçamento connosco</h1>
            <a href="{{ route('show.form') }}" class="btn bg-primary-subtle">Pedir Orçamento</a>
        @endguest
    </div>
</div>

@endsection





