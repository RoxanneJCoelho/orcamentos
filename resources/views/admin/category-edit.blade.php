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

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Novo nome</label>
            <input required name="name" type="text" class="form-control" value="">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
    @endsection
</div>
