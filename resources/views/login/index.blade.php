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
            background-color: black;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 2.5rem 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 1px;
        }

        label {
            font-weight: 600;
        }

        input.form-control {
            background-color: #f8f9fa;
            color: #000;
            border-radius: 0.4rem;
            padding: 0.5rem 0.75rem;
            transition: box-shadow 0.3s ease;
        }

        input.form-control:focus {
            box-shadow: 0 0 8px #0d6efd;
            border-color: #0d6efd;
            outline: none;
        }

        .btn-primary, .btn-secondary {
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.6rem 1rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.5);
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.5);
        }

        .alert {
            font-size: 0.9rem;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('entrar') }}" class="login-container">
        @csrf

        <h2><i class="bi bi-box-arrow-in-right me-2"></i>Login do Usuário</h2>

        {{-- Mensagens de erro --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}" autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
            <i class="bi bi-box-arrow-in-right me-1"></i> Entrar </button>

        {{-- <a href="{{ route('registrar.create') }}" class="btn btn-secondary w-100">
            <i class="bi bi-person-plus me-1"></i> Registrar
        </a> --}}
    </form>
</body>

</html>
