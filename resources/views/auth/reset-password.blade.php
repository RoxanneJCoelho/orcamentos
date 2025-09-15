{{-- View da recuperação de senha (submeter nova pass) --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Recuperação de senha')

@section('content')

<div class="homepage-container d-flex flex-column flex-lg-row min-vh-100">

    <div class="homepage-left d-flex flex-column p-5 justify-content-center align-items-center mb-4">
        <h2 class="text-center">Recuperação de senha</h2>
        <form method="POST" class="w-100 login-form" action="{{ route('password.update') }}">
            @csrf
            <div class="mb-3">

                {{-- Email --}}
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input name="email" value="{{ request()->email }}" type="email" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
            </div>
            <div class="mb-3">

                {{-- Nova password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" />
                </div>

                {{-- Confirmação da nova password --}}
                <label for="password" class="form-label">Confirmar nova password</label>
                <input type="password" class="form-control" name="password_confirmation" />
            </div>

            {{-- Validação de erros --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <button type="submit" class="btn bg-primary-subtle w-100">Submeter nova password</button>
        </form>
    </div>

    {{-- Imagem --}}
    <div class="homepage-right">
        <img src="{{ asset('assets/images/password-recovery/password.jpg') }}" alt="homepage" class="homepage-image">
    </div>
</div>

@endsection
