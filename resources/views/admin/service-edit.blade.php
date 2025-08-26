@extends('layouts.master')

@section('title', 'OrçamentosJá - Editar Serviço')

@section('content')
<div class='container'>
    <h3>Editar Serviço nº {{ $myService->code }} : {{ $myService->description }}</h3>
    <h5>Edite apenas nos campos onde precisa editar, o resto pode deixar em branco</h5>

    <form method="POST" action="{{ route('edit.service.store', $myService->id) }}">
        @csrf
        @method('PUT')

        <!-- hidden id -->
        <input type="hidden" name="id" value="{{ $myService->id }}">

        {{-- Campo do código --}}
        <div class="mb-3">
            <label for="code" class="form-label">Novo Código</label>
            <input name="code" type="text" class="form-control" id="code" placeholder="{{ $myService->code }}">
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo da descrição --}}
        <div class="mb-3">
            <label for="description" class="form-label">Nova Descrição</label>
            <input name="description" type="text" class="form-control" id="description"
                placeholder="{{ $myService->description }}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo do preço --}}
        <div class="mb-3">
            <label for="price" class="form-label">Novo Preço</label>
            <input name="price" type="text" class="form-control" id="price" placeholder="{{ $myService->price }}">
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo do desconto --}}
        <div class="mb-3">
            <label for="discount" class="form-label">Novo Desconto</label>
            <input name="discount" type="text" class="form-control" id="discount"
                placeholder="{{ $myService->discount }}">
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
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
    </form>
</div>
@endsection
