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
            <input type="text" name="code" id="editCode" class="form-control" placeholder="{{ $myService->code }}" aria-describedby="editCode">
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descrição --}}
        <div class="mb-3">
            <label for="editDescription" class="form-label">Nova Descrição</label>
            <input type="text" name="description" id="editDescription" class="form-control"
                placeholder="{{ $myService->description }}" aria-describedby="editDescription">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Preço --}}
        <div class="mb-3">
            <label for="editPrice" class="form-label">Novo Preço</label>
            <input type="text" name="price" id="editPrice" class="form-control" placeholder="{{ $myService->price }}" aria-describedby="editPrice">
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Desconto --}}
        <div class="mb-3">
            <label for="editDiscount" class="form-label">Novo Desconto</label>
            <input type="text" name="discount" id="editDiscount" class="form-control"
                placeholder="{{ $myService->discount }}" aria-describedby="editDiscount">
            @error('discount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
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
        <button type="submit" class="btn bg-primary-subtle">Atualizar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
</div>
@endsection
