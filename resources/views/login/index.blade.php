<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Sistema de Tarefas</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background-image: url('https://4kwallpapers.com/images/wallpapers/macos-monterey-stock-black-dark-mode-layers-5k-3840x2160-5889.jpg');
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            background-color: rgba(255, 255, 255, 0.06);
            padding: 2.5rem 2rem;
            border-radius: 1.2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            color: #fff;
        }

        h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.3rem;
        }

        .form-control {
            background-color: #ffffff;
            color: #000;
            border: none;
            border-radius: 0.5rem;
            padding: 0.65rem 1rem;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 8px #0d6efd;
            border: none;
            outline: none;
        }

        .btn-primary {
            background-color: #1e90ff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.65rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #044888;
            box-shadow: 0 4px 12px rgba(3, 87, 167, 0.4);
        }

        .alert {
            font-size: 0.9rem;
            border-radius: 0.5rem;
            background-color: rgba(220, 53, 69, 0.9);
            border: none;
            color: #fff;
        }

        .input-group-text {
            background-color: #1e90ff;
            color: #fff;
            border: none;
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .form-label {
            margin-bottom: 0.2rem;
        }

        .input-group {
            margin-bottom: 1.2rem;
        }

        .icon-hover i {
            transition: all 0.3s ease;
            color: white;
        }

        .icon-hover:hover i {
            color: #ccce71;
            /* Azul Bootstrap */
            transform: scale(1.2);
            text-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('entrar') }}" class="login-container">
        @csrf
        <div class="d-flex justify-content-end">
            <a class="nav-link text-white fs-5 icon-hover" href="{{ route('sobres') }}">
                <i class="bi bi-exclamation-circle" style="font-size: 26px"></i>
            </a>

        </div>

        <h2><i class="bi bi-box-arrow-in-right me-2"></i>Login</h2>

        {{-- Mensagens de erro --}}
        @if ($errors->any())
            <div class="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li><i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="email" class="form-label">E-mail</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" name="email" id="email" class="form-control" required
                value="{{ old('email') }}" autofocus>
        </div>

        <label for="password" class="form-label">Senha</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">
            <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
        </button>

        {{-- <a href="{{ route('registrar.create') }}" class="btn btn-outline-light w-100 mt-2">
            <i class="bi bi-person-plus me-1"></i> Registrar-se
        </a> --}}

        <footer class="text-white-50 text-center py-3 mt-2 small">
            Desenvolvido por Renan Pilan • {{ now()->year }}
        </footer>
    </form>
</body>

</html>
