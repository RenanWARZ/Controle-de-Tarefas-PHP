<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tarefas</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
       body {
            background-image: url("https://img.freepik.com/vetores-gratis/gradient-fluid-background-suitable-for-cover-and-banner-poster_343694-4460.jpg?semt=ais_hybrid&w=740");
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
            max-width: 500px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>

        <a href="{{ route('login') }}" class="btn btn-primary btn-lg"
        style="position: absolute; top: 20px; right: 20px;"> Voltar </a>

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <form method="POST" action="{{ route('registrar.store') }}" class="login-container text-white ">
            @csrf
        <h2 class="mb-4"> Registrar Novo Usuário</h2>

        <div class="form-group mb-3">
            <label for="name" class="name mb-2">Nome do Usuário:</label>
            <input type="name" name="name" id="name" class="form-control" style="width: 280px">
        </div>

         <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" style="width: 320px" required>
            </div>

            <div class="form-group mb-4">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" id="password" style="width: 250px" class="form-control" required>
            </div>

        <button class="btn btn-primary btn-lg mt-2 text-center"> Registrar </button>
    </form>
</body>
</html>
