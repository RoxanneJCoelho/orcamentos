{{-- View para editar dados do admin --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Alterar Dados')

@section('content')
<div class='container'>
    <h3>Alterar Dados</h3>

    <form method="POST" action="{{ route('edit.profile.store')}}">
        @csrf
        @method('PUT')

        {{-- Nome --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}">
        </div>

        {{-- Morada --}}
        <div class="mb-3">
            <label for="morada" class="form-label">Morada:</label>
            <input type="text" name="morada" class="form-control" value="{{ old('morada', Auth::user()->morada) }}">
        </div>

        {{-- NIPC e Telemóvel --}}
        <div class="row mb-3">
            <div class="col-6">
                <label for="NIPC" class="form-label">NIPC:</label>
                <input type="text" name="NIF/NIPC" class="form-control" value="{{ old('NIF/NIPC', Auth::user()->{'NIF/NIPC'}) }}">
            </div>
            <div class="col-6">
                <label for="telemovel" class="form-label">Telemóvel:</label>
                <input type="text" name="telemovel" class="form-control" value="{{ old('telemovel', Auth::user()->telemovel) }}">
            </div>
        </div>

        {{-- Botão alterar --}}
        <button type="submit" class="btn bg-primary-subtle">Alterar</button>

        {{-- Botão cancelar --}}
        <a href="{{ route('show.profile') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
</div>
@endsection
