@extends('components.layouts.app')

@section('content')

    <x-alertas />

    <div class="tarefas-header">
        <div class="card mt-4 mb-4 shadow-sm rounded-4 border-0">
            <div class="card-header bg-dark text-white rounded-top-4 d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0">
                    <i class="bi bi-list-check me-2"></i> Tarefas de {{ $usuario->user->name }}
                </h2>
            </div>

            <div class="card-body">

                @if (Auth::user()->tipo_user)
                <div class="text-end mb-4">
                    <a href="{{ route('tarefas.create', ['usuario' => $usuario->id]) }}" class="btn btn-primary shadow-sm"
                        aria-label="Criar nova tarefa para {{ $usuario->name }}">
                        <i class="bi bi-plus-lg me-1"></i> Nova Tarefa </a>
                    </div>
                    @endif


            <div class="card-body mb-4">
                <form action="{{ route('tarefas.index', ['usuario' => $usuario->id]) }}" method="GET" class="mb-4">

                    <div class="row justify-content-center g-3 align-items-end text-start">

                        {{-- ID da tarefa --}}
                        <div class="col-auto">
                            <label for="id" class="form-label">ID:</label>
                            <input type="number" name="id" class="form-control" placeholder="ID da tarefa"
                                value="{{ request('id') }}">
                        </div>

                        {{-- Nome da tarefa --}}
                        <div class="col-auto">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" name="task" class="form-control" placeholder="Nome da tarefa"
                                value="{{ request('task') }}">
                        </div>

                        {{-- Setor --}}
                        <div class="col-auto">
                            <label for="setor_id" class="form-label">Setor:</label>
                            <select name="setor_id" class="form-select">
                                <option value="">Todos os setores</option>
                                @foreach ($setores as $setor)
                                    <option value="{{ $setor->id }}"
                                        {{ request('setor_id') == $setor->id ? 'selected' : '' }}>
                                        {{ $setor->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Busca genérica --}}
                        <div class="col-auto">
                            <label for="busca" class="form-label">Pesquisar:</label>
                            <input type="text" name="busca" class="form-control" placeholder="Buscar texto"
                                value="{{ request('busca') }}">
                        </div>

                        <div class="row justify-content-center align-items-end g-3">
                            {{-- Data Inicial --}}
                            <div class="col-auto">
                                <label for="prazo" class="form-label">Prazo Inicial:</label>
                                <input type="date" name="prazo" id="prazo" class="form-control"
                                    value="{{ request('prazo') }}">
                            </div>

                            {{-- Data Final --}}
                            <div class="col-auto">
                                <label for="prazofinal" class="form-label">Prazo Final:</label>
                                <input type="date" name="prazofinal" id="prazofinal" class="form-control"
                                    value="{{ request('prazofinal') }}">
                            </div>
                        </div>

                        {{-- Botão Filtrar --}}
                        <div class="row mt-4 mb-2">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Filtrar
                                </button>

                            <a href="{{ route('tarefas.index', ['usuario' => $usuario->id]) }}" class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise"></i> Atualizar  </a>

                            </div>
                        </div>
                    </div>
                </form>

                <hr>
                {{-- Resultado da busca --}}
                @isset($tarefa)
                    <hr>
                    <h5>Resultado:</h5>
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
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }} á
                            {{ \Carbon\Carbon::parse($tarefa->prazofinal)->format('d/m/Y') }}</dd>

                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-8">
                            @if ($tarefa->concluida)
                                <span class="badge bg-success ms-1">Concluída</span>
                            @else
                                <span class="badge bg-warning text-dark ms-1">Pendente</span>
                            @endif
                        </dd>
                    </dl>
                @endisset
            </div>

            @forelse ($tarefas as $tarefa)
                <div class="card mb-3 shadow-sm rounded-3 border-0 tarefa-card-hover">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1">
                                <span class="badge bg-secondary me-2">#{{ $tarefa->id }}</span>
                                <a style="text-decoration: none; color:black"
                                    href="{{ route('tarefas.show', ['usuario' => $usuario->id, 'tarefa' => $tarefa->id]) }}">{{ $tarefa->task }}</a>

                                @if ($tarefa->concluida)
                                    <span class="badge bg-success ms-2">Concluída</span>
                                @else
                                    <span class="badge bg-warning text-dark ms-2">Pendente</span>
                                @endif
                            </h5>

                            <dt class="mb-2">👤 Atribuída a: {{ $tarefa->usuario->user->name ?? 'Usuário não encontrado' }} </dt>
                            <p class="tarefa-descricao" title="{{ $tarefa->descricao }}">{{ $tarefa->descricao }}</p>
                            <small class="text-muted">
                                <strong>Início:</strong> {{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }} |
                                <strong>Fim:</strong> {{ \Carbon\Carbon::parse($tarefa->prazofinal)->format('d/m/Y') }}
                            </small>
                        </div>

                        <div class="d-flex align-items-center gap-3 flex-column flex-sm-row">

                                <a href="{{ route('tarefas.edit', ['usuario' => $usuario->id, 'tarefa' => $tarefa->id]) }}"
                                    class="btn btn-sm btn-outline-warning" title="Editar"
                                    aria-label="Editar tarefa #{{ $tarefa->id }}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form method="POST"
                                    action="{{ route('tarefas.destroy', ['usuario' => $usuario->id, 'tarefa' => $tarefa->id]) }}"
                                    onsubmit="return confirm('Deseja excluir essa tarefa?')" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir"
                                        aria-label="Excluir tarefa #{{ $tarefa->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                                <a href="{{ route('tarefas.show', ['usuario' => $usuario->id, 'tarefa' => $tarefa->id]) }}"
                                    class="btn btn-sm btn-outline-info" title="Exibir"
                                    aria-label="Exibir detalhes da tarefa #{{ $tarefa->id }}">
                                    <i class="bi bi-eye"></i>
                                </a>

                            <form method="POST"
                                action="{{ route('tarefas.update', ['usuario' => $usuario->id, 'tarefa' => $tarefa->id]) }}"
                                class="m-0 d-flex align-items-center">
                                @csrf
                                @method('PATCH')
                                <label class="switch mb-0" for="concluida-{{ $tarefa->id }}">
                                    <input type="checkbox" name="concluida" onchange="this.form.submit()"
                                        id="concluida-{{ $tarefa->id }}" {{ $tarefa->concluida ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <label for="concluida-{{ $tarefa->id }}"
                                    class="mb-0 ms-2 user-select-none">Concluída</label>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted fs-5 mt-5">Nenhuma tarefa atribuída ainda.</p>
            @endforelse
        </div>
    </div>
    </div>
@endsection
