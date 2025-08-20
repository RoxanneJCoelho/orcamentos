<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('login')}}" method="POST">
    @csrf
    <h3>Log in in Your account</h3>
    <label for="email">Email:</label>
    <input
        type="email"
        name="email"
        required
        value="{{old('email')}}" // manter os dados do formulário após falhas de validação, melhorando a experiência do utilizador
        >
    <label for="password">Password:</label>
    <input
        type="password"
        name="password"
        required
        >
    <button type="submit">Log in</button>

    {{-- validations errors --}}
    @if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>
            {{$error}}
        </li>
        @endforeach
    </ul>
    @endif

</form>
</body>
</html>
