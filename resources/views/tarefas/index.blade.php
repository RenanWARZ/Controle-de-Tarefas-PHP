@extends('components.layouts.app')

@section('content')
    <div class="container mt-5">

        {{-- CARD DE FILTRO --}}
        <div class="card shadow-lg border-0 rounded-4 mb-5">
            <div class="card-header bg-dark text-white rounded-top-4">
                <h4 class="mb-0 d-flex align-items-center">
                    <i class="bi bi-filter-circle-fill me-2 fs-4"></i> Filtrar Tarefas
                </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('tarefas.index', ['usuario' => Auth::user()->id]) }}" method="GET">
                    <div class="row g-3">

                        {{-- ID --}}
                        <div class="col-md-2">
                            <label for="id" class="form-label">ID:</label>
                            <input type="number" name="id" class="form-control" placeholder="ID"
                                value="{{ request('id') }}">
                        </div>

                        {{-- Nome da tarefa --}}
                        <div class="col-md-4">
                            <label for="task" class="form-label">Nome da Tarefa:</label>
                            <input type="text" name="task" class="form-control" placeholder="Ex: Revisar projeto"
                                value="{{ request('task') }}">
                        </div>

                        {{-- Setor --}}
                        <div class="col-md-3">
                            <label for="setor_id" class="form-label">Setor:</label>
                            <select name="setor_id" class="form-select">
                                <option value="">Todos os Setores</option>
                                @foreach ($setores as $setor)
                                    <option value="{{ $setor->id }}"
                                        {{ request('setor_id') == $setor->id ? 'selected' : '' }}>
                                        {{ $setor->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Busca geral --}}
                        <div class="col-md-3">
                            <label for="busca" class="form-label">Pesquisar:</label>
                            <input type="text" name="busca" class="form-control" placeholder="Palavra-chave"
                                value="{{ request('busca') }}">
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        {{-- Prazo inicial --}}
                        <div class="col-md-3">
                            <label for="prazo" class="form-label">Prazo Inicial:</label>
                            <input type="date" name="prazo" class="form-control" value="{{ request('prazo') }}">
                        </div>

                        {{-- Prazo final --}}
                        <div class="col-md-3">
                            <label for="prazofinal" class="form-label">Prazo Final:</label>
                            <input type="date" name="prazofinal" class="form-control"
                                value="{{ request('prazofinal') }}">
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- RESULTADO ÚNICO --}}
        @isset($tarefa)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="mb-3"><i class="bi bi-check-circle me-2 text-success"></i> Resultado:</h5>
                    <dl class="row">
                        <dt class="col-sm-3">Id:</dt>
                        <dd class="col-sm-9">{{ $tarefa->id }}</dd>

                        <dt class="col-sm-3">Título:</dt>
                        <dd class="col-sm-9">{{ $tarefa->task }}</dd>

                        <dt class="col-sm-3">Descrição:</dt>
                        <dd class="col-sm-9">{{ $tarefa->descricao }}</dd>

                        <dt class="col-sm-3">Responsável:</dt>
                        <dd class="col-sm-9">{{ $tarefa->usuario->user->name ?? 'Não atribuído' }}</dd>

                        <dt class="col-sm-3">Setor:</dt>
                        <dd class="col-sm-9">{{ $tarefa->usuario->setor->nome ?? 'Não informado' }}</dd>

                        <dt class="col-sm-3">Data de Entrega:</dt>
                        <dd class="col-sm-9">
                            {{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }} à
                            {{ \Carbon\Carbon::parse($tarefa->prazofinal)->format('d/m/Y') }}
                        </dd>

                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9">
                            @if ($tarefa->concluida)
                                <span class="badge bg-success">Concluída</span>
                            @else
                                <span class="badge bg-warning text-dark">Pendente</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        @endisset

        {{-- LISTA DE TAREFAS --}}
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-dark text-white rounded-top-4 d-flex align-items-center">
                <h4 class="mb-0"><i class="bi bi-card-checklist me-2"></i> Tarefas Atribuídas</h4>
            </div>

            <div class="card-body">
                @forelse ($tarefas as $tarefa)
                    <div class="card mb-3 shadow-sm border-0 rounded-3">
                        <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1 " style="display: ruby;">
                                    <span class="badge bg-secondary me-2">#{{ $tarefa->id }}</span>
                                    <a href="{{ route('tarefas.show', ['usuario' => Auth::user()->id, 'tarefa' => $tarefa->id]) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $tarefa->task }}
                                    </a>
                                    @if ($tarefa->concluida)
                                        <span class="badge bg-success ms-2">Concluída</span>
                                    @else
                                        <span class="badge bg-warning text-dark ms-2">Pendente</span>
                                    @endif

                                                                    <form method="POST"
                                    action="{{ route('tarefas.update', ['usuario' => Auth::user()->id, 'tarefa' => $tarefa->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <label class="switch mb-0">
                                        <input type="checkbox" name="concluida" onchange="this.form.submit()"
                                            {{ $tarefa->concluida ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </form>
                                </h5>


                                <p class="mb-1"><strong>👤 Atribuída a:</strong>
                                    {{ $tarefa->usuario->user->name ?? 'Usuário não encontrado' }}</p>
                                <p class="mb-1 text-muted">{{ $tarefa->descricao }}</p>
                                <small class="text-muted">
                                    <strong>Setor:</strong> {{ $tarefa->usuario->setor->nome ?? 'Não informado' }} |
                                    <strong>Início:</strong> {{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }} |
                                    <strong>Fim:</strong> {{ \Carbon\Carbon::parse($tarefa->prazofinal)->format('d/m/Y') }}
                                </small>
                            </div>

                            <div class="d-flex flex-column flex-sm-row align-items-start gap-2">
                                @if (Auth::user()->tipo_user)
                                    <a href="{{ route('tarefas.edit', ['usuario' => Auth::user()->id, 'tarefa' => $tarefa->id]) }}"
                                        class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form method="POST"
                                        action="{{ route('tarefas.destroy', ['tarefa' => $tarefa->id]) }}"
                                        onsubmit="return confirm('Deseja excluir essa tarefa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('tarefas.show', ['tarefa' => $tarefa->id]) }}"
                                    class="btn btn-sm btn-outline-info" title="Visualizar">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Marcar como concluída --}}

                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted fs-5 mt-4">Nenhuma tarefa atribuída ainda.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
