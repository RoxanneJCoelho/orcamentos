@extends('layouts.master')

@section('content')
<form action="{{route('login')}}" method="POST">
    @csrf
    <h3>Log in in Your account</h3>
    <label for="email">Email:</label>
    <input type="email" name="email" required value="{{old('email')}}" // manter os dados do formulário após falhas de
        validação, melhorando a experiência do utilizador>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
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
@endsection


</body>

</html>
