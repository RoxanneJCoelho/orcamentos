{{-- View layouts - estrutura visual desta app --}}

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/navbar/icon.png') }}">

    {{-- Google Fonts - Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    {{-- Ficheiro Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    {{-- Ficheiro CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-md bg-primary-subtle">
        <div class="container-fluid">

            {{-- Logo --}}
            <a class="navbar-brand" href="{{ route('show.homepage') }}">
                <img src="{{ asset('assets/images/navbar/logo.png') }}" alt="OrçamentosJá" class="logo-img">
            </a>

            {{-- Elementos visíveis para não autenticados --}}
            @guest
            <a href="{{ route('show.login') }}" class="nav-link login-btn ms-auto mt-2 me-3">
                <img src="{{ asset('assets/images/navbar/login.png') }}" alt="Login" class="img-fluid">
            </a>
            @endguest

             {{-- Elementos visíveis para autenticados --}}
            @auth
            {{-- Botão toggler (hamburger) --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{ asset('assets/images/navbar/home.png') }}" alt="Home" class="img-fluid">
            </button>

            {{-- Menu colapsável --}}
            <div class="collapse navbar-collapse" id="navbarContent">
                <div class="d-flex align-items-center ms-auto flex-column flex-md-row">

                    {{-- Mensagem de boas-vindas --}}
                    <a href="{{ route('show.admin') }}" class="me-md-5 mb-2 mb-md-0 mt-2 text-dark text-decoration-none">Bem-vind@, {{ Auth::user()->name }}</a>

                    {{-- Dropdown Mais opções --}}
                    <ul class="navbar-nav me-md-5 mb-2 mb-md-0 mt-2">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Mais opções
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Categorias</a></li>
                                <li><a class="dropdown-item" href="#">Serviços</a></li>
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                            </ul>
                        </li>
                    </ul>

                    {{-- Botão logout --}}
                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="nav-link logout-btn mt-2 me-3">
                            <img src="{{ asset('assets/images/navbar/logout.png') }}" alt="Logout" class="img-fluid">
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>


    @yield('content')

    {{-- Ficheiro Bootstrap JS --}}
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>

    @yield('scripts')
</body>

</html>
