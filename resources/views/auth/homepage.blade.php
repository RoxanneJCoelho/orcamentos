<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OrcamentosJa</title>
</head>
<body>
    <h1>Faça o seu orçamento connosco!</h1>
    <a href="{{ route('show.form') }}">
        <button type="button">Pedir Orçamento</button>
    </a>
    @guest
    <a href="{{ route('show.login') }}">
        <button type="button">Login</button>
    </a>
    @endguest
    @auth
    <span>
        hi there, {{Auth::user()->name}}
    </span>
    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button>Logout</button>
    </form>
    @endauth
</body>
</html>
