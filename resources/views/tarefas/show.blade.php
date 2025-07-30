@extends('components.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-4"></i> Visualizar Tarefas
                </h3>

                <a href="{{ route('tarefas.index', ['usuario' => $usuario->id]) }}" class="btn btn-outline-light btn">
                    <i class="bi bi-arrow-left-circle me-1"></i> Voltar </a>
            </div>

            <div class="card-body">
                <x-alertas />

                <div class="row">
                    <div class="col-md-8 mx-auto mt-3">
                        <h4 class="card-title mb-4 border-bottom pb-1">📋 Detalhes da Tarefa</h4>

                        <dl class="row">
                            <dt class="mb-2">👤 Atribuída: {{ $tarefa->usuario->user->name ?? 'Usuário não encontrado' }}
                            </dt> <br>
                            <dt class="mb-2">📝 Tarefa: {{ $tarefa->task }}</dt>
                            <dt class="mb-2">🧾 Descrição: {{ $tarefa->descricao ?: 'Sem descrição.' }}</dt>
                            <dt class="mb-2">📅 Data Inicial: {{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }} </dt>
                            <dt class="mb-3">❌ Data Final: {{ \Carbon\Carbon::parse($tarefa->prazofinal)->format('d/m/Y') }}</dt>


                            <dt style="font-size: 20px"> ✅ Status:
                                <span style="font-size: 18px"
                                    class="badge {{ $tarefa->concluida ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $tarefa->concluida ? 'Concluída' : 'Pendente' }}
                                </span>
                            </dt>
                        </dl>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
