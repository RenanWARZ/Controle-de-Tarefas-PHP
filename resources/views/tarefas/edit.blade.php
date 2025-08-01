@extends('components.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient bg-dark text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i> Editar Tarefa de {{ $usuario->name }}
            </h4>
            <a href="{{ route('tarefas.index', ['usuario' => $usuario->id ?? 0]) }}" class="btn btn-sm btn-outline-light">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>

        <div class="card-body p-4">
            <x-alertas />

            <form action="{{ route('tarefas.update', ['tarefa' => $tarefa->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label for="task" class="form-label fw-semibold">📝 Nome da Tarefa</label>
                    <input
                        type="text"
                        class="form-control shadow-sm"
                        id="task"
                        name="task"
                        value="{{ old('task', $tarefa->task) }}"
                        placeholder="Digite o nome da tarefa"
                        required
                    >
                    <div class="invalid-feedback">
                        Por favor, insira o nome da tarefa.
                    </div>
                </div>

                <div class="mb-4">
                    <label for="descricao" class="form-label fw-semibold">📄 Descrição</label>
                    <textarea
                        class="form-control shadow-sm"
                        id="descricao"
                        name="descricao"
                        rows="4"
                        placeholder="Detalhes da tarefa (opcional)"
                    >{{ old('descricao', $tarefa->descricao) }}</textarea>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="prazo" class="form-label fw-semibold">📆 Data Inicial</label>
                        <input
                            type="date"
                            class="form-control shadow-sm"
                            id="prazo"
                            name="prazo"
                            value="{{ old('prazo', $tarefa->prazo) }}"
                            required
                        >
                        <div class="invalid-feedback">
                            Por favor, escolha a data inicial.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="prazofinal" class="form-label fw-semibold">📅 Data Final</label>
                        <input
                            type="date"
                            class="form-control shadow-sm"
                            id="prazofinal"
                            name="prazofinal"
                            value="{{ old('prazofinal', $tarefa->prazofinal) }}"
                            required
                        >
                        <div class="invalid-feedback">
                            Por favor, escolha a data final.
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <button type="submit" class="btn btn-success px-4 shadow-sm">
                        <i class="bi bi-check-circle me-1"></i> Salvar
                    </button>
                    <a href="{{ route('tarefas.index', ['usuario' => $usuario->id ?? 0]) }}" class="btn btn-outline-secondary px-4 shadow-sm">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
