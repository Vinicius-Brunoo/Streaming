<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Streaming Music')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg app-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('musicas.index') }}">
                <span class="brand-mark"><i class="bi bi-music-note-beamed"></i></span>
                Copia Barata do Spotify
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('musicas.*') ? 'active' : '' }}" href="{{ route('musicas.index') }}">
                            <i class="bi bi-disc"></i> Musicas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('playlists.*') ? 'active' : '' }}" href="{{ route('playlists.index') }}">
                            <i class="bi bi-collection-play"></i> Playlists
                        </a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-pill" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('musicas.create') }}">
                                        <i class="bi bi-plus-circle"></i> Nova musica
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('playlists.create') }}">
                                        <i class="bi bi-plus-circle"></i> Nova playlist
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-box-arrow-right"></i> Sair
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-accent btn-sm" href="{{ route('register') }}">Cadastrar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4 py-lg-5">
        @if ($errors->any())
            <div class="alert alert-danger app-alert">
                <strong>Revise os campos:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @if (session('success') || session('warning'))
        <div class="toast-container app-toast-container">
            @if (session('success'))
                <div class="toast app-toast app-toast-success" role="status" aria-live="polite" aria-atomic="true" data-bs-delay="4000">
                    <div class="toast-body">
                        <span><i class="bi bi-check-circle"></i> {{ session('success') }}</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Fechar"></button>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="toast app-toast app-toast-warning" role="status" aria-live="polite" aria-atomic="true" data-bs-delay="5000">
                    <div class="toast-body">
                        <span><i class="bi bi-exclamation-circle"></i> {{ session('warning') }}</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Fechar"></button>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.app-toast').forEach((toastElement) => {
            new bootstrap.Toast(toastElement).show();
        });
    </script>
    @stack('scripts')
</body>
</html>
