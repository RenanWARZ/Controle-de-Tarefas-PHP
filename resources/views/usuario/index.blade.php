@extends('components.layouts.app')

@section('content')

    <div class="card mt-4 mb-4 border-light shadow-sm rounded-4">
        <div class="card-header d-flex align-items-center justify-content-between bg-dark text-white rounded-top-4">
            <h3 class="mb-0"><i class="bi bi-people-fill me-2"></i>Usuários</h3>
        </div>

        <div class="card-body p-3">
            <x-alertas />

            @if ($usuarios->isEmpty())
                <p class="text-center text-muted fs-5 my-4">Nenhum usuário cadastrado.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">
                        <thead class="table-secondary text-uppercase">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Papel</th>
                                <th>Data</th>
                                <th>Criado em</th>
                                @if (Auth::user()->tipo_user)
                                    <th class="text-center">Ações</th>
                                @endif
                                {{-- <th>Tarefas</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <th scope="row">{{ $usuario->id }}</th>
                                    <td>{{ $usuario->user->name }}</td>
                                    <td>{{ $usuario->user->email }}</td>
                                    <td>{{ $usuario->user->tipo_user ? 'Administrador' : 'Usuário' }} </td>
                                    <td>{{ \Carbon\Carbon::parse($usuario->created_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($usuario->created_at)->setTimezone('America/Sao_Paulo')->format('H:i:s') }}</td>


                                    @if (Auth::user()->tipo_user)
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('usuario.show', $usuario->user->id) }}"
                                                class="btn btn-outline-primary btn-sm" title="Visualizar">
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            <a href="{{ route('usuario.edit', $usuario->user->id) }}"
                                                class="btn btn-outline-warning btn-sm" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('usuario.destroy', $usuario->user->id) }}"
                                                class="m-0" onsubmit="return confirm('Excluir este usuário?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    title="Deletar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                    @endif
                                    </td>
                                    {{-- <td>
                                            <a href="{{ route('tarefas.index', ['usuario' => $usuario->id]) }}"
                                                class="btn btn-outline-info btn-sm" title="Ver tarefas">
                                                <i class="bi bi-list-task"></i>
                                            </a>
                                        </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
