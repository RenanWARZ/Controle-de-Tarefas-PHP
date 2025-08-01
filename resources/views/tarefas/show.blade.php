@extends('components.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient bg-dark text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                    <i class="bi bi-person-circle fs-4"></i> Visualizar Tarefa
                </h3>
                <a href="{{ route('tarefas.index', ['usuario' => Auth::user()->id]) }}" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left-circle me-1"></i> Voltar
                </a>
            </div>

            <div class="card-body">
                <x-alertas />

                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8 mt-3">
                        <h4 class="card-title mb-4 pb-2 border-bottom">📋 Detalhes da Tarefa</h4>

                        <dl class="row">
                            <dt class="col-sm-4 text-muted"><i class="bi bi-person-fill-check me-2 text-primary"></i>Responsável</dt>
                            <dd class="col-sm-8">{{ $tarefa->usuario?->user?->name ?? 'Usuário não encontrado' }}</dd>

                            <dt class="col-sm-4 text-muted"><i class="bi bi-card-text me-2 text-primary"></i>Nome da Tarefa</dt>
                            <dd class="col-sm-8">{{ $tarefa->task }}</dd>

                            <dt class="col-sm-4 text-muted"><i class="bi bi-file-earmark-text me-2 text-primary"></i>Descrição</dt>
                            <dd class="col-sm-8">{{ $tarefa->descricao ?: 'Sem descrição.' }}</dd>

                            <dt class="col-sm-4 text-muted"><i class="bi bi-calendar-check me-2 text-success"></i>Data Inicial</dt>
                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }}</dd>

                            <dt class="col-sm-4 text-muted"><i class="bi bi-calendar-x me-2 text-danger"></i>Data Final</dt>
                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($tarefa->prazofinal)->format('d/m/Y') }}</dd>

                            <dt class="col-sm-4 text-muted"><i class="bi bi-clipboard-check me-2 text-warning"></i>Status</dt>
                            <dd class="col-sm-8">
                                <span class="badge px-3 py-2 fs-6 {{ $tarefa->concluida ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $tarefa->concluida ? 'Concluída' : 'Pendente' }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
