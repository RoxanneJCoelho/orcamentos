{{-- View para visualizar os dados do admin --}}
@extends('layouts.master')

@section('title', 'OrçamentosJá - Perfil')

@section('content')
<div class='container'>

    {{-- Perfil --}}
    <h3>Perfil</h3>

    <p>Nome:</p>
    <p>Morada:</p>
    <p>NIPC:</p>
    <p>Telemóvel:</p>

    {{-- Botão alterar dados --}}
    <a href="{{ route('edit.profile') }}" class="btn bg-primary-subtle">Alterar Dados</a>

    {{-- Botão alterar password --}}
    <a href="{{ route('edit.profile.password') }}" class="btn btn-light text-primary border">Alterar Password</a>
</div>
@endsection
