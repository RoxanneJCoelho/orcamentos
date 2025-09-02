@extends('layouts.master')

@section('title', 'OrçamentosJá - Editar Serviço')

@section('content')
<div class='container'>
    <h3>Editar Serviço nº {{ $myService->code }} : {{ $myService->description }}</h3>
    <h5>Edite apenas nos campos onde precisa editar, o resto pode deixar em branco</h5>

    <form method="POST" action="{{ route('edit.service.store', $myService->id) }}">
        @csrf
        @method('PUT')

        {{-- ID escondido --}}
        <input type="hidden" name="id" value="{{ $myService->id }}">

        {{-- Código --}}
        <div class="mb-3">
            <label for="editCode" class="form-label">Novo Código</label>
            <input type="text" name="code" id="editCode" class="form-control" value="{{ $myService->code }}"
             aria-describedby="editCode">
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descrição --}}
        <div class="mb-3">
            <label for="editDescription" class="form-label">Nova Descrição</label>
            <input type="text" name="description" id="editDescription" class="form-control"
                value="{{ $myService->description }}"
                aria-describedby="editDescription">
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
                    <input type="number" name="price" id="price" class="form-control" value="{{ $myService->price }}" aria-describedby="price" step="0.01" min="0">
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
                        value="{{ $myService->discount }}" 
                        aria-describedby="discount" step="0.01" min="0" max="100">
                    <span class="input-group-text">%</span>
                </div>
                @error('discount')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Selecionar a categoria --}}
        <div class="mb-3">
            <label for="categorySelect" class="form-label">Mudar categoria</label>
            <select name="category_id" id="categorySelect" class="form-select">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $myService->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Botão atualizar --}}
        <button type="submit" class="btn bg-primary-subtle">Atualizar</button>

        {{-- Botão cancelar --}}
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
</div>
@endsection
