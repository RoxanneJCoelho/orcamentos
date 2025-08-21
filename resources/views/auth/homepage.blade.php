@extends('layouts.master')

@section('content')
<h1>Faça o seu orçamento connosco!</h1>
<a href="{{ route('show.form') }}">
    <button type="button">Pedir Orçamento</button>
</a>
@endsection

