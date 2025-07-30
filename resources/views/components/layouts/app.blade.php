<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <title>@yield('title', 'Sistema de Tarefas')</title>
</head>

<body style="background: black">
    <!-- NAVBAR FORA DO HEAD -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- Botão de abrir o menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral"
                aria-controls="menuLateral" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Título no topo -->
            <a class="navbar-brand fw-bold fs-4 ms-3" href="{{ route('welcome') }}"> Gerenciador de Tarefas </a>

            <!-- MENU LATERAL -->
            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="menuLateral"
                aria-labelledby="menuLateralLabel">
                <div class="offcanvas-header bg-dark">
                    <h5 class="offcanvas-title fw-bold text-white " id="menuLateralLabel">
                        <i class="bi bi-menu-button-wide-fill me-2"></i> Menu Principal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Fechar"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-column gap-2">
                        <li class="nav-item">
                            <span class="text-uppercase text-secondary small">Navegação</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="{{ route('welcome') }}">
                                <i class="bi bi-house-door-fill me-2"></i> Início
                            </a>
                        </li>

                        @if (Auth::user()->tipo_user)
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white fs-5 nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-list-task me-2"></i> Admin
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('usuario.create') }}">Cadastrar</a></li>
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="{{ route('usuario.index') }}">
                                <i class="bi bi-person-lines-fill me-2"></i> Tarefas
                            </a>
                        </li>

                        <li class="nav-item">
                            <span class="text-uppercase text-secondary small">Outros</span>
                        </li>
                    </ul>
                </div>

                <div class="nav-item d-flex justify-content-between align-items-center px-3 text-white mb-3">
                    <div>
                        Usuário: {{ Auth::user()->name }} <br>
                        Email: {{ Auth::user()->email }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger btn-sm d-flex align-items-center">
                            <i class="bi bi-box-arrow-right me-1"></i> Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="container mt-4 pt-5">
        @yield('content')
        @stack('scripts')
    </div>
</body>
</html>
