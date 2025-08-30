@extends('layouts.master')

@section('title', 'OrçamentosJá - Alterar Dados')

@section('content')
<div class='container'>
    <h3>Alterar Dados</h3>

    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="morada" class="form-label">Morada:</label>
        <input type="text" name="morada" class="form-control">
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="NIF" class="form-label">NIPC:</label>
            <input type="text" name="NIF" class="form-control">
        </div>
        <div class="col-6">
            <label for="telemovel" class="form-label">Telemóvel:</label>
            <input type="text" name="telemovel" class="form-control">
        </div>
    </div>

    <button type="submit" class="btn bg-primary-subtle">Alterar</button>
    <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
</div>
@endsection
