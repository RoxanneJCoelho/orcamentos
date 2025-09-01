{{-- View da página inicial --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Página Inicial')

@section('content')

<div class="homepage-container d-flex flex-column flex-lg-row min-vh-100">

    {{-- Imagem --}}
    <div class="homepage-left">
        <img src="{{ asset('assets/images/homepage/homepage.jpg') }}" alt="homepage" class="homepage-image">
    </div>

    {{-- Texto --}}
    <div class="homepage-right d-flex flex-column justify-content-center align-items-center text-center p-4">
        <h1 class="mb-3">Faça o seu orçamento connosco</h1>
        <a href="{{ route('show.form') }}" class="btn bg-primary-subtle">Pedir Orçamento</a>
    </div>
</div>

@endsection





