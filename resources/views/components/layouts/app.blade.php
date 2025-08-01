<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/suavizar.css') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="">
    <title>@yield('title', 'Sistema de Tarefas')</title>

</head>

<body
    style="background-image: url('https://4kwallpapers.com/images/wallpapers/macos-monterey-stock-black-dark-mode-layers-5k-3840x2160-5889.jpg');
    background-size: cover;
    background-repeat: no-repeat;">

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- Botão de abrir o menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral"
                aria-controls="menuLateral" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <a class="ms-2 navbar-brand"> Gerenciador de Tarefas </a></button>

            <!-- Direita da navbar -->
            <div class="d-flex align-items-center ms-auto gap-3">

                <!-- Botão de notificação -->
                <button type="button" class="btn btn-dark position-relative" data-bs-toggle="modal"
                    data-bs-target="#ExemploModalCentralizado">
                    <i class="bi bi-bell-fill fs-5"></i>
                    @if ($qtdeNotificacoes)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $qtdeNotificacoes ?? 0 }}
                            <span class="visually-hidden">notificações não lidas</span>
                        </span>
                    @endif
                </button>

                <!-- Dropdown do usuário -->
                <li class="nav-item dropdown list-unstyled m-0">
                    <a class="nav-link text-white fs-5 dropdown-toggle d-flex align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-2 fs-4"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('usuario.show', Auth::user()->id) }}">Perfil</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('usuario.edit', Auth::user()->id) }}">Editar
                                Conta</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">Sair</button>
                            </form>
                        </li>
                    </ul>
                </li>

            </div>
        </div>

        @if ($qtdeNotificacoes)
            <!-- Badge com número de notificações -->
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $qtdeNotificacoes ?? 0 }}
                <span class="visually-hidden">notificações não lidas</span>
            </span>
        @endif
        </button>

        <!-- MENU LATERAL -->
        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="menuLateral"
            aria-labelledby="menuLateralLabel">
            <div class="offcanvas-header bg-dark">
                <h5 class="offcanvas-title fw-bold text-white " id="menuLateralLabel">
                    <i class="bi bi-list me-2"></i> Menu Principal </h5>

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
                            <i class="bi bi-house-door-fill me-2"></i> Início </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link text-white fs-5 nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-lines-fill me-2"></i> Usuario </a>


                        <ul class="dropdown-menu dropdown-menu-dark">
                            @if (Auth::user()->tipo_user)
                                <li><a class="dropdown-item" href="{{ route('usuario.create') }}">Cadastrar</a></li>

                                <li><a class="dropdown-item" href="{{ route('usuario.index') }}">Ver usuarios</a>
                                </li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('usuario.show', Auth::user()->id) }}">Seu
                                        usuário</a></li>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link text-white fs-5 nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-clipboard2-check-fill" me-2"></i> Tarefas </a>

                        <ul class="dropdown-menu dropdown-menu-dark">
                            @if (Auth::user()->tipo_user)
                                <li><a class="dropdown-item" href="{{ route('tarefas.create') }} ">Nova tarefa</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('tarefas.index', Auth::user()->id) }}">Pesquisar</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('tarefas.index', Auth::user()->id) }}">Ver
                                        suas tarefas</a>
                                </li>
                            @endif
                    </li>
                </ul>

                <li class="nav-item">
                    <span class="text-uppercase text-secondary small">Outros</span>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-white fs-5 d-flex align-items-center" href="{{ route('sobre') }}">
                        <i class="bi bi-info-circle-fill me-2"></i> Sobre </a>
                </li>
            </div>

            <div class="text-white mt-4 px-3 small">
                <div class="mb-2 d-flex align-items-center">
                    <i data-feather="eye-off" class="me-2"></i> <strong>ID:</strong>&nbsp; {{ Auth::user()->id }}
                </div>
                <div class="mb-2 d-flex align-items-center">
                    <i data-feather="user" class="me-2"></i> <strong>Usuário:</strong>&nbsp;
                    {{ Auth::user()->name }}
                </div>

                <div class="mb-2 d-flex align-items-center">
                    <i data-feather="shield" class="me-2"></i> <strong>Tipo:</strong>&nbsp;
                    {{ Auth::user()->tipo_user ? 'Administrador' : 'Usuário' }}
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <i data-feather="mail" class="me-2"></i> <strong>Email:</strong>&nbsp;
                    {{ Auth::user()->email }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger w-100 d-flex align-items-center justify-content-center mb-2">
                        <i class="bi bi-box-arrow-right me-2"></i> Sair
                    </button>
                </form>
            </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="container mt-4 pt-5">


        @yield('content')

        <x-modal-notificacoes :id="Auth::user()->id" />

        @stack('scripts')
    </div>


    <!-- Rodapé opcional -->
    <footer class="text-white-50 text-center py-3 mt-5 small">
        Desenvolvido por Renan Pilan • {{ now()->year }}
    </footer>

    <script src="{{ asset('js/suavizar.js') }}"></script>
</body>

</html>
