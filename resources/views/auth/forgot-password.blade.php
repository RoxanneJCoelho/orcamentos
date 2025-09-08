{{-- View da recuperação de senha (por o email) --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Recuperação de senha')

@section('content')

<div class="homepage-container d-flex flex-column flex-lg-row min-vh-100">

    <div class="homepage-left d-flex flex-column p-5 justify-content-center align-items-center mb-4">
        <h2 class="text-center">Recuperação de senha</h2>
        <form action="{{ route('password.email') }}" method="POST" class="w-100 login-form">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
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
