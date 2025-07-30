<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>


    <title>@yield('title', 'Sistema de Tarefas')</title>
</head>

<body
    style="background-image: url('https://img.freepik.com/vetores-gratis/fundo-com-padrao-de-textura-de-fibra-de-carbono-preta_1017-33436.jpg');
    background-size: cover;
    background-repeat: no-repeat;">

    <!-- NAVBAR FORA DO HEAD -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- Botão de abrir o menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral"
                aria-controls="menuLateral" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <a class="ms-2 navbar-brand"> Gerenciador de Tarefas </a>
            </button>


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
                                <i class="bi bi-house-door-fill me-2"></i> Início </a>
                        </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link text-white fs-5 nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-list-task me-2"></i> Usuario </a>

                                  <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('usuario.create') }}">Cadastrar</a></li>

                                    <li><a class="dropdown-item" href="{{ route('usuario.index') }}">Ver usuarios</a>
                                    </li>
                                </ul>
                            </li>

                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="{{ route('usuario.index') }}">
                                <i class="bi bi-person-lines-fill me-2"></i> Tarefas
                            </a>
                        </li>

                        <li class="nav-item">
                            <span class="text-uppercase text-secondary small">Outros</span>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="{{ route('sobre') }}">
                                <i data-feather="codesandbox"></i> Sobre </a>
                        </li>
                </div>

                <div class="nav-item text-white px-3 mb-3">
                    <div class="mb-2"><i data-feather="award" class="me-1"></i> Id: {{ Auth::user()->id }}</div>
                    <div class="mb-2"><i data-feather="user" class="me-1"></i> Usuário: {{ Auth::user()->name }}
                    </div>
                    <div class="mb-2"><i data-feather="shield" class="me-1"></i> Tipo:
                        {{ Auth::user()->tipo_user ? 'Administrador' : 'Usuário' }}</div>
                    <div class="mb-2"><i data-feather="mail" class="me-1"></i> Email: {{ Auth::user()->email }}
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="justify-content-end d-flex mb-2 mx-2">
                        <button class="btn btn-danger d-flex align-items-center text-end">
                            <i class="bi bi-box-arrow-right me-1"></i> Sair </button>
                    </div>
                </form>
            </div>

            <!-- Botão para abrir o modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                data-bs-target="#ExemploModalCentralizado"> <i data-feather="bell"></i>
            </button>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="container mt-4 pt-5">


        @yield('content')

        <x-modal-notificacoes :id="Auth::user()->id" />

        @stack('scripts')
    </div>

    <script>
        feather.replace();
    </script>

</body>

</html>
