{{-- View para adicionar serviço á BD --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Adicionar Serviço')

@section('content')
<div class='container'>
    <h3>Adicionar Serviço</h3>

    <form method="POST" action="{{ route('add.service.store') }}">
        @csrf

        {{-- Código --}}
        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}"
                aria-describedby="code" required>
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descrição --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}"
                aria-describedby="description" required>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Preço e Desconto --}}
        <div class="row mb-3">

            {{-- Preço --}}
            <div class="col-6">
                <label for="price" class="form-label">Preço</label>
                <div class="input-group">
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                        aria-describedby="price" required step="0.01" min="0">
                    <span class="input-group-text">€</span>
                </div>
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Desconto --}}
            <div class="col-6">
                <label for="discount" class="form-label">Desconto</label>
                <div class="input-group">
                    <input type="number" name="discount" id="discount" class="form-control"
                        value="{{ old('discount') }}" aria-describedby="discount" required step="0.01" min="0"
                        max="100">
                    <span class="input-group-text">%</span>
                </div>
                @error('discount')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Selecionar a categoria --}}
        <div class="mb-3">
            <label for="userSelect" class="form-label">Selecionar a categoria</label>
            <select name="category_id" id="userSelect" class="form-select" required>
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Escolha uma categoria --
                </option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach

                @error('category_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </select>
        </div>

        <button type="submit" class="btn bg-primary-subtle">Adicionar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
</div>
@endsection
