{{-- View para adicionar serviço á BD --}}

@extends('layouts.master')

@section('content')
<div class='container'>
    <h3>Adicionar Serviço</h3>
    <form method="POST" action="{{ route('add.service.store') }}">
        @csrf
        {{-- Campo do código --}}
        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input required name="code" type="text" class="form-control" id="code" value="{{ old('code') }}">
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo da descrição --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input required name="description" type="text" class="form-control" id="description" value="{{ old('description') }}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo do preço --}}
        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input required name="price" type="text" class="form-control" id="price" value="{{ old('price') }}">
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo do desconto --}}
        <div class="mb-3">
            <label for="discount" class="form-label">Desconto</label>
            <input required name="discount" type="text" class="form-control" id="discount" value="{{ old('discount') }}">
            @error('discount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Selecionar a categoria --}}
        <div class="mb-3">
            <label for="userSelect" class="form-label">Selecionar categoria</label>
            <select name="category_id" id="userSelect" class="form-select" required>
                <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>-- Escolha uma categoria --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('user_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
</div>
@endsection
