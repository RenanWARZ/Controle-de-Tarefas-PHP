<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>@yield('title', 'Sistema de Tarefas')</title>

    <style>
        /* Fundo geral */
        body {
            background-image: url("https://img.freepik.com/vetores-gratis/gradient-fluid-background-suitable-for-cover-and-banner-poster_343694-4460.jpg?semt=ais_hybrid&w=740");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        /* Header fixo padrão */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgb(17, 40, 156);
            color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 1030;
            padding: 0.75rem 1rem;
            backdrop-filter: saturate(180%) blur(10px);
        }

        header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header a.nav-link,
        header a.text-white,
        header button.btn-logout {
            font-size: 1.25rem;
            font-weight: 600;
            color: white;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        header a.nav-link:hover,
        header a.text-white:hover,
        header button.btn-logout:hover {
            color: #ffdd57;
        }

        .btn-logout {
            padding: 0;
            font-size: 1.1rem;
        }

        
        main.container {
            margin-top: 100px;
            margin-bottom: 30px;
            color: #212529;

        }

        /* Cards padrão para conteúdo */
        .card {
            border-radius: 12px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.15);
            background-color: rgba(255 255 255 / 0.9);
            color: #212529;
        }

        /* Para botões primários e secundários padrão */
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0a58ca;
            border-color: #0a58ca;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #565e64;
            border-color: #565e64;
        }

        /* Links padrão do menu lateral ou superior */
        nav a {
            color: #e9ecef;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        nav a:hover,
        nav a.active {
            color: #ffffff;
        }

        /* Centralizar e organizar ações para visitantes */
        .guest-actions {
            margin-top: 90px;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
    </style>

    @stack('styles')
</head>

<body>

    @auth
        <header>
            <div class="container text-center">

                {{-- Botão de Atualizar --}}
                <button onclick="location.reload();"
                    class="btn btn-lg text-white text-decoration-none d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-clockwise"></i> Atualizar
                </button>

                {{-- Botão home --}}
                <a href="{{ url('/') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                    <i class="bi bi-list-task fs-3"></i>
                    <span class="fs-4 fw-bold">Sistema de Tarefas</span>
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn-logout" title="Sair">
                        <i class="bi bi-box-arrow-right"></i> Sair </button>
                </form>
            </div>
        </header>
    @endauth

    @guest
        <div class="guest-actions">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">Entrar</a>
            <a href="{{ route('registrar.create') }}" class="btn btn-secondary btn-lg px-4">Registrar</a>
        </div>
    @endguest

    <main class="container">
        @yield('content')
    </main>

    <!-- JS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts')
</body>

</html>
