@extends('layouts.master')

@section('title', 'OrçamentosJá - Alterar Dados')

@section('content')
<div class='container'>
    <h3>Alterar Password</h3>

    <div class="mb-3">
        <label for="passwordantiga" class="form-label">Password antiga:</label>
        <input type="password" name="passwordantiga" class="form-control">
    </div>
    <div class="mb-3">
        <label for="newpassword" class="form-label">Password nova:</label>
        <input type="password" name="newpassword" class="form-control">
    </div>
    <div class="mb-3">
        <label for="confirmarpasswordnova" class="form-label">Confirmar Password nova:</label>
        <input type="password" name="confirmarpasswordnova" class="form-control">
    </div>

    <button type="submit" class="btn bg-primary-subtle">Alterar</button>
    <a href="{{ route('show.admin') }}" class="btn btn-light text-primary border">Cancelar</a>
</div>
@endsection

