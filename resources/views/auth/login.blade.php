{{-- View do login --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Login')

@section('content')

<div class="homepage-container d-flex flex-column flex-lg-row min-vh-100">

    <div class="homepage-left d-flex flex-column p-5">
        <h2 class="text-center justify-content-center align-items-center mb-4">Bem-vindo à área pessoal do OrçamentosJá</h2>
        <form action="{{ route('login') }}" method="POST" class="w-100 login-form">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            {{-- Esqueci me da Password --}}
            <div class="mb-4">
                <a href="{{ route('password.request') }}">Esqueci-me da Password</a>
            </div>

            {{-- Submeter --}}
            <div class="mb-4">
                <button type="submit" class="btn bg-primary-subtle w-100">Login</button>
            </div>
        </form>

        {{-- Validação de erros --}}
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
        @endif
    </div>

    {{-- Imagem --}}
    <div class="homepage-right">
        <img src="{{ asset('assets/images/login/login.jpg') }}" alt="homepage" class="homepage-image">
    </div>
</div>

@endsection
