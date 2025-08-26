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
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" aria-describedby="code" required>
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descrição --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" aria-describedby="description" required>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Preço --}}
        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" aria-describedby="price" required>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Desconto --}}
        <div class="mb-3">
            <label for="discount" class="form-label">Desconto</label>
            <input type="text" name="discount" id="discount" class="form-control"  value="{{ old('discount') }}" aria-describedby="discount" required>
            @error('discount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Selecionar a categoria --}}
        <div class="mb-3">
            <label for="userSelect" class="form-label">Selecionar a categoria</label>
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

        <button type="submit" class="btn bg-primary-subtle">Adicionar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
</div>
@endsection
