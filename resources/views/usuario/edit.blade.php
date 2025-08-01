@extends('components.layouts.app')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow rounded-4 ">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white rounded-top-4">
            <h2 class="mb-0">Editar Usuário</h2>
            <a href="{{ route('usuario.index') }}" class="btn btn-outline-light btn">
                <i class="bi bi-arrow-left-circle me-1"></i> Voltar
            </a>
        </div>

        <form action="{{ route('usuario.update', $usuario->user->id) }}" method="POST" class="row g-4 p-4" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            {{-- Inclua o form parcial aqui, garanta que ele esteja com as classes Bootstrap corretas --}}
            @include('usuario.partials.form', ['usuario' => $usuario])

            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4 shadow-sm">
                    <i class="bi bi-check-lg me-2"></i> Atualizar
                </button>
            </div>
        </form>
    </div>
@endsection
