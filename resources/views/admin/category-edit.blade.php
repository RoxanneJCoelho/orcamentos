{{-- View para editar categoria á BD --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Editar Categoria')

@section('content')
<div class='container'>
    <h3>Editar Categoria {{ $myCategory->name }}</h3>

    <form method="POST" action="{{ route('edit.category.store', $myCategory->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value=" {{ $myCategory->id }}">

        {{-- Nome --}}
        <div class="mb-3">
            <label for="editCategoryName" class="form-label">Novo nome</label>
            <input type="text" name="name" id="editCategoryName" class="form-control" required aria-describedby="editCategoryName">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn bg-primary-subtle">Atualizar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
    @endsection
</div>
