@extends('layouts.master')

@section('content')

<div class="d-flex flex-column flex-lg-row login-container min-vh-100 d-flex flex-wrap">

    <!-- Texto à direita (desktop) / em baixo (mobile) -->
    <div class="flex-md-fill d-flex flex-column justify-content-start justify-content-lg-center align-items-center p-3 mx-4 login-text">
        <h2>Recuperação de Senha</h2>
        <form action="{{ route('login') }}" method="POST" class="w-100 login-form">
            @csrf
            {{-- Email --}}
            <div class="my-5">
                <label for="code" class="form-label">Código enviado</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>
            {{-- Submit --}}
            <div class="d-grid my-5">
                <button type="submit" class="btn btn-primary">
                    Recuperar Password
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
      <div class="flex-md-fill password-recovery-image">

    </div>
</div>

@endsection
