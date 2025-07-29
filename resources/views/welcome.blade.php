@extends('components.layouts.app')

@section('title', 'Bem-vindo')

@section('content') 
    <div class="text-center text-white">
        <h1 class="display-4 mb-4">Bem-vindo ao Gerenciador de Tarefas</h1>
        <p class="lead mb-5">Organize suas tarefas, atribua responsáveis e acompanhe o progresso de cada setor.</p>


        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="card bg-dark border-success shadow text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-person-fill-check me-2"></i>Gestão de Usuários</h5>
                        <p class="card-text">Adicione, edite e organize os responsáveis pelas tarefas com facilidade.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-dark border-primary shadow text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-list-task me-2"></i>Controle de Tarefas</h5>
                        <p class="card-text">Crie tarefas, defina prazos e acompanhe o andamento de cada uma delas.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-dark border-warning shadow text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-diagram-3-fill me-2"></i>Setores e Equipes</h5>
                        <p class="card-text">Organize as tarefas por setor e distribua entre os times da empresa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

