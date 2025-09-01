{{-- View para visualizar os dados do admin --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Perfil')

@section('content')
<div class='container'>

    {{-- Perfil --}}
    <h3>Perfil</h3>

    {{-- Mensagem de inserção de dados bem sucedida --}}
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    @endif

    <p>Nome: {{ $user->name }}</p>
    <p>Morada: {{ $user->morada }}</p>
    <p>NIPC: {{ $user->{'NIF/NIPC'} }}</p>
    <p>Telemóvel: {{ $user->telemovel }}</p>

    {{-- Botão alterar dados --}}
    <a href="{{ route('edit.profile') }}" class="btn bg-primary-subtle">Alterar Dados</a>

    {{-- Botão alterar password --}}
    <a href="{{ route('edit.profile.password') }}" class="btn btn-light text-primary border">Alterar Password</a>
</div>
@endsection
