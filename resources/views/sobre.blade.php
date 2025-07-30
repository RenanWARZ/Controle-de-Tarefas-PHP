@extends('components.layouts.app')

@section('title', 'Sobre o Projeto')

@section('content')
    <style>
        .bg-gradient-dark {

            color: white;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .highlight {
            color: #0077ff;
        }

        .icon-box {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 12px;
        }

        .icon-box:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

    </style>

    <section class="bg-gradient-dark py-5 ">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="section-title">Sobre o <span class="highlight">Gerenciador de Tarefas</span></h1>
                <p class="lead">Uma solução intuitiva para gestão eficiente de atividades e equipes em diferentes setores.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="icon-box text-center h-120">
                        <i class="bi bi-speedometer2 fs-1 text-warning mb-3"></i>
                        <h4 class="fw-bold">Alta Produtividade</h4>
                        <p>Facilite o acompanhamento e conclusão das tarefas com agilidade e organização.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box text-center h-100">
                        <i class="bi bi-shield-lock fs-1 text-info mb-3"></i>
                        <h4 class="fw-bold">Segurança e Controle</h4>
                        <p>Gerencie permissões com níveis de acesso para administradores e usuários comuns.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box text-center h-100">
                        <i class="bi bi-bar-chart-line fs-1 text-success mb-3"></i>
                        <h4 class="fw-bold">Visão Estratégica</h4>
                        <p>Tenha uma visão clara das tarefas por setor e otimize a performance da sua equipe.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('welcome', auth()->user()->id ?? 1) }}" class="btn btn-outline-light btn-lg">
                    Começar a Usar
                </a>
            </div>
        </div>
    </section>
@endsection
