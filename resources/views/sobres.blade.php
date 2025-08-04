<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre o Sistema</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-image: url('https://4kwallpapers.com/images/wallpapers/macos-monterey-stock-black-dark-mode-layers-5k-3840x2160-5889.jpg');
            color: #e6edf3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: bold;
            background: linear-gradient(to right, #58a6ff, #1f6feb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .lead {
            font-size: 1.15rem;
            color: #c9d1d9;
            max-width: 700px;
            margin: 0 auto;
        }

        .icon-card {
            background-color: #0707078a;
            border-radius: 20px;
            padding: 30px 20px;
            height: 100%;
            box-shadow: 0 0 15px rgba(31, 111, 235, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .icon-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(31, 111, 235, 0.2);
        }

        .icon-card i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #58a6ff;
        }

        .btn-cta {
            background-color: #000000;
            color: #fff;
            border: none;
            padding: 12px 35px;
            border-radius: 30px;
            font-size: 1.15rem;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-cta:hover {
            background-color: #388bfd;
            transform: scale(1.05);
        }

        .highlight {
            color: #58a6ff;
        }

        @media (max-width: 767px) {
            .section-title {
                font-size: 2.2rem;
            }

            .icon-card {
                padding: 25px 15px;
            }
        }
    </style>
</head>
<body>
 <style>
        .bg-gradient-dark {
            color: white;
        }
        .section-title {
            font-size: 2.8rem;
            font-weight: bold;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .icon-box {
            background-color: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            padding: 25px;
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .icon-box:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.2);
        }

        .icon-box i {
            transition: transform 0.3s;
        }

        .icon-box:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        .btn-outline-light {
            border-radius: 30px;
            padding: 10px 30px;
        }

        .lead {
            font-size: 1.2rem;
        }
    </style>

    <section class="bg-gradient-dark py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="section-title">Sobre o <span class="highlight">Gerenciador de Tarefas</span></h1>
                <p class="lead text-light">Uma solução intuitiva para gestão eficiente de atividades e equipes em diferentes setores.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="icon-box text-center h-100">
                        <i class="bi bi-speedometer2 fs-1 text-warning mb-3"></i>
                        <h4 class="fw-bold text-light">Alta Produtividade</h4>
                        <p class="text-light">Facilite o acompanhamento e conclusão das tarefas com agilidade e organização.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box text-center h-100">
                        <i class="bi bi-shield-lock fs-1 text-info mb-3"></i>
                        <h4 class="fw-bold text-light">Segurança e Controle</h4>
                        <p class="text-light">Gerencie permissões com níveis de acesso para administradores e usuários comuns.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="icon-box text-center h-100">
                        <i class="bi bi-bar-chart-line fs-1 text-success mb-3"></i>
                        <h4 class="fw-bold text-light">Visão Estratégica</h4>
                        <p class="text-light">Tenha uma visão clara das tarefas por setor e otimize a performance da sua equipe.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('welcome', auth()->user()->id ?? 1) }}" class="btn btn-outline-light btn-lg shadow">
                    Começar a Usar
                </a>
            </div>
        </div>
    </section>
</body>
</html>
