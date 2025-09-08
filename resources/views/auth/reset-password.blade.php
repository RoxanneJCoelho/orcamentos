{{-- View da recuperação de senha (submeter nova pass) --}}

@extends('layouts.master')

@section('title', 'OrçamentosJá - Recuperação de senha')

@section('content')

<div class="homepage-container d-flex flex-column flex-lg-row min-vh-100">

    <div class="homepage-left d-flex flex-column p-5 justify-content-center align-items-center mb-4">
        <h2 class="text-center">Recuperação de senha</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" value="{{ request()->email }}" type="email" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" />
                @error('password')
                <div class="invalid-feedback"></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" />
            </div>
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
