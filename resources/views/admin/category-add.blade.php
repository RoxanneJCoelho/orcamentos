{{-- View para adicionar categoria á BD --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Adicionar Categoria')

@section('content')
<div class='container'>
    <h3>Adicionar Categoria</h3>

    <form method="POST" action="{{ route('add.category.store') }}">
        @csrf

        {{-- Nome --}}
        <div class="mb-3">
            <label for="addCategoryName" class="form-label">Nome</label>
            <input type="text" name="name" id="addCategoryName" class="form-control" aria-describedby="addCategoryName" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn bg-primary-subtle">Adicionar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
    @endsection
</div>
