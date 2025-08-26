{{-- View layouts - estrutura visual desta app --}}

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/icon.png') }}">

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
    <nav class="navbar navbar-expand-lg bg-primary-subtle">
        <div class="container-fluid">

            {{-- Logo --}}
            <a class="navbar-brand" href="{{ route('show.homepage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="OrçamentosJá" class="logo-img">
            </a>

            {{-- Botão toggler para mobile --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                Mais opções
            </button>

            {{-- Conteúdo colapsável --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @auth
                {{-- Itens à direita --}}
                <div class="d-flex align-items-center ms-auto">

                    {{-- Mensagem de boas-vindas --}}
                    <span class="me-3">Bem-vind@, {{ Auth::user()->name }}</span>

                    {{-- Dropdown Mais opções --}}
                    <ul class="navbar-nav me-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
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
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link logout-btn p-0">
                            <img src="{{ asset('assets/images/logout.png') }}" alt="Logout" class="img-fluid">
                        </button>
                    </form>
                </div>
                @endauth

                @guest
                {{-- Botão login à direita --}}
                <div class="d-flex ms-auto">
                    <a href="{{ route('show.login') }}" class="nav-link login-btn">
                        <img src="{{ asset('assets/images/login.png') }}" alt="Login" class="img-fluid">
                    </a>
                </div>
                @endguest

            </div>
        </div>
    </nav>

    @yield('content')

    {{-- Ficheiro Bootstrap JS --}}
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>

    @yield('scripts')
</body>

</html>
