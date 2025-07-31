@extends('components.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Editar Tarefa de {{ $usuario->name }}</h4>
        </div>

        <div class="card-body" style="background-color: rgb(188, 188, 188)">
            <x-alertas />

            <form action="{{ route('tarefas.update', ['tarefa' => $tarefa->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="task" class="form-label fw-semibold">Tarefa</label>
                    <input
                        type="text"
                        class="form-control"
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

                <div class="mb-3">
                    <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    <textarea
                        class="form-control"
                        id="descricao"
                        name="descricao"
                        rows="4"
                        placeholder="Detalhes da tarefa (opcional)"
                    >{{ old('descricao', $tarefa->descricao) }}</textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="prazo" class="form-label fw-semibold">Prazo Inicial</label>
                        <input
                            type="date"
                            class="form-control"
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
                        <label for="prazofinal" class="form-label fw-semibold">Prazo Final</label>
                        <input
                            type="date"
                            class="form-control"
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

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Salvar Alterações</button>
                    <a href="{{ route('tarefas.index', ['usuario' => isset($usuario->id) ? $usuario->id : 0]) }}" class="btn btn-outline-secondary px-4">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
