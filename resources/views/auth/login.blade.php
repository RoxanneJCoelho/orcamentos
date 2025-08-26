@extends('layouts.master')

@section('title', 'OrçamentosJá - Login')

@section('content')
<div class="container">
    <h2>Faça o login para aceder á área privada do OrçamentosJá</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Email --}}

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                Log in
            </button>
        </div>
    </form>

    {{-- Validation Errors (se não usares @error individual) --}}
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        {{ $errors->first() }}
    </div>
    @endif

</div>
@endsection
