@extends('components.layouts.app')

@section('content')
    <div class="card mt-4 mb-4 shadow border-light rounded-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top-4">
            <h2 class="mb-0">Detalhes do {{ $usuario->name }}</h2>
            <a href="{{ route('usuario.index') }}" class="btn btn-outline-light btn">
                <i class="bi bi-arrow-left-circle me-1"></i> Voltar
            </a>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('usuario.destroy', $usuario->id) }}" class="position-absolute top-1 end-0 me-3"
                onsubmit="return confirm('Deseja excluir este usuário?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn" title="Deletar">
                    <i class="bi bi-trash"></i>
                </button>
            </form>

            <span class="badge bg-secondary me-2 mt-3 fs-5"> # {{ $usuario->id }} </span>

            <div class="row gy-4">
                <div class="col-md-6 d-flex align-items-center gap-4">
                    <div style="flex-shrink: 0;">
                        @if ($usuario->foto)
                            <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto do usuário"
                                class="img-thumbnail rounded-circle shadow-sm"
                                style="width: 180px; height: 180px; object-fit: cover;">
                        @else
                            <img src="{{ asset('storage/usuarios/default.png') }}" alt="Imagem padrão"
                                class="img-thumbnail rounded-circle shadow-sm"
                                style="width: 180px; height: 180px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="fs-5">
                        <p><strong>Nome:</strong> {{ $usuario->user->name }}</p>
                        <p><strong>Email:</strong> {{ $usuario->user->email }}</p>
                        <p><strong>Setor:</strong> {{ $usuario->setor->nome ?? 'Não atribuído' }}</p>
                        <p><strong>Senha: **************</p></strong>
                    </div>
                </div>

                <!-- Coluna das datas -->
                <div class="col-md-6">
                    <div class="card shadow-sm border rounded-4 p-3 h-100 bg-light">
                        <p><strong>Criado em:</strong><br>
                            {{ \Carbon\Carbon::parse($usuario->created_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                        </p>

                        <p><strong>Editado em:</strong><br>
                            {{ \Carbon\Carbon::parse($usuario->updated_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                        </p>

                        <p><strong>Visualizado em:</strong><br>
                            {{ now()->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
