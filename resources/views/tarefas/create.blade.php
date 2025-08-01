@extends('components.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient bg-dark text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <h1 class="h4 fw-bold mb-0 text-light">Nova tarefa</h1>
                <a href="{{ route('usuario.index') }}"
                    class="btn btn-outline-secondary text-light d-flex align-items-center gap-1"><i class="bi bi-arrow-left"></i> Voltar </a>
            </div>

            <div class="card-body px-4 py-4">

                <x-alertas />

                {{-- Mensagens de erro --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tarefas.store') }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf

                    <div class="form-floating mb-4 col-md-6">
                        <input type="text" class="form-control form-control-lg rounded-3" id="task" name="task"
                            placeholder="Nome da tarefa" required value="{{ old('task') }}">
                        <label for="task" class="fw-semibold">Nome da Tarefa</label>
                        <div class="invalid-feedback ps-3">Por favor, insira o nome da tarefa.</div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-3 form-floating">
                            <input type="date" class="form-control rounded-3 ms-1" id="prazo" name="prazo"
                                value="{{ old('prazo') }}" placeholder="Prazo Inicial">
                            <label for="prazo" class="fw-semibold ms-3">Prazo Inicial</label>
                        </div>

                        <div class="col-md-3 form-floating">
                            <input type="date" class="form-control rounded-3 ms-1" id="prazofinal" name="prazofinal"
                                value="{{ old('prazofinal') }}" placeholder="Prazo Final">
                            <label for="prazofinal" class="fw-semibold ms-3">Prazo Final</label>
                        </div>
                    </div>

                    <div class="form-floating mb-4 col-md-8">
                        <textarea class="form-control rounded-3 ms-1" placeholder="Descrição" id="descricao" name="descricao" style="height: 120px;">{{ old('descricao') }}</textarea>
                        <label for="descricao" class="fw-semibold ms-3">Descrição</label>
                    </div>

                    <div class="mb-4 col-md-4">
                        <label for="usuario_id" class="form-label fw-semibold">Atribuir ao usuário</label>
                        <select class="form-select form-select-lg rounded-3" id="usuario_id" name="usuario_id" required>
                            <option value="" disabled selected>-- Selecione um usuário --</option>
                            @foreach ($usuarios as $u)
                                <option value="{{ $u->id_user }}">
                                     {{ $u->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="" class="btn btn-outline-secondary px-4 rounded-3 fw-semibold"> Cancelar </a>

                        <button type="submit" class="btn btn-primary px-5 rounded-3 fw-semibold d-flex align-items-center gap-2">
                            <i class="bi bi-plus-lg fs-5"></i> Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
