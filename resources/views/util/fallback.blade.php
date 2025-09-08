{{-- View fallback - se o utilizador colocar uma rota desconhecida --}}

@extends('layouts.master')

@section('title', 'Página não encontrada')

@section('content')

<div class="d-flex flex-column justify-content-center align-items-center text-center p-4">
    <h1 class="mb-3">Página não encontrada</h1>
    <h2 class="mb-3">Clique no botão abaixo para ir para a página principal</h2>
    <a href="{{ route('show.homepage') }}" class="btn bg-primary-subtle">Ir para a página principal</a>
</div>

@endsection
