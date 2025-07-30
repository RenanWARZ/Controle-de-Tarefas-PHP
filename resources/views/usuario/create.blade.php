@extends('components.layouts.app')

@section('content')

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

    
    <div class="card mt-4 mb-4 border-light shadow rounded-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white rounded-top-4">
            <h2 class="mb-0">Cadastrar Usuário</h2>
            <a href="{{ route('welcome') }}" class="btn btn-outline-light btn">
                <i class="bi bi-arrow-left-circle me-1"></i> Voltar </a>
        </div>

        <form action="{{ route('usuario.store') }}" method="POST" class="row g-4 p-4" enctype="multipart/form-data" novalidate>
            @csrf

            @include('usuario.partials.form')

            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                    <i class="bi bi-plus-lg me-2"></i> Cadastrar
                </button>
            </div>
        </form>
    </div>
@endsection
