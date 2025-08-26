{{-- View para adicionar categoria á BD --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Adicionar Categoria')

@section('content')
<div class='container'>
    <h3>Adicionar Categoria</h3>
    <form method="POST" action="{{ route('add.category.store') }}">
        @csrf
        {{-- Campo do nome --}}
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nome</label>
            <input required name="name" type="text" class="form-control" id="exampleInputName" aria-describedby="name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
    @endsection
</div>
