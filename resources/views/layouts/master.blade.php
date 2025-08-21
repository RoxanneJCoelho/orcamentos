<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OrcamentosJa</title>
    <!-- Bootstrap CSS local -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('show.homepage')}}">OrcamentosJa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @guest
                    <a href="{{ route('show.login') }}" class="btn btn-link nav-link" style="padding: 0;">
                        Login
                    </a>
                    @endguest
                    @auth
                    <span>
                        hi there, {{Auth::user()->name}}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link"
                            style="padding: 0; border: none; background: none;">
                            Logout
                        </button>
                    </form>

                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @yield('content')

    <!-- Bootstrap JS local -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>

    @yield('scripts')
</body>

</html>
