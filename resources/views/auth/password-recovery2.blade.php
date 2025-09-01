{{-- View da recuperação de senha (por o código --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Recuperação de senha')

@section('content')

<div class="homepage-container d-flex flex-column flex-lg-row min-vh-100">

    <div class="homepage-left d-flex flex-column p-5 justify-content-center align-items-center mb-4">
        <h2 class="text-center">Recuperação de senha</h2>
        <form action="{{ route('login') }}" method="POST" class="w-100 login-form">
            @csrf

            {{-- Código --}}
            <div class="mb-3">
                <label for="code" class="form-label">Código enviado</label>
                <input type="text" name="code" id="code" class="form-control" aria-describedby="code" required">
            </div>

            {{-- Submeter --}}
            <div class="mb-4">
                <button type="submit" class="btn bg-primary-subtle w-100">Recuperar password</button>
            </div>
        </form>
    </div>

    {{-- Imagem --}}
    <div class="homepage-right">
        <img src="{{ asset('assets/images/password-recovery/password.jpg') }}" alt="homepage" class="homepage-image">
    </div>
</div>

@endsection
