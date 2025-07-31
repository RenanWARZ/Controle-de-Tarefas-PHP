<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <!-- Cabeçalho -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="TituloModalCentralizado">
                    <i class="bi bi-bell-fill me-2"></i> Notificações                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <!-- Corpo -->
            <div class="modal-body bg-dark" style="">
                @forelse ($notificacoes as $notificacao)
                    <div class="mb-3 p-3 border-start border-4 border-info rounded bg-white shadow-sm">
                        <div class="d-flex justify-content-between">
                            <strong class="text-primary">
                                <i ></i>📌 {{ $notificacao['titulo'] }}
                            </strong>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($notificacao['created_at'])->format('d/m/Y') }}</small>
                        </div>
                        <div class="mt-1 text-dark">{{ $notificacao['descricao'] }}</div>
                    </div>
                @empty
                    <p class="text-center fs-5 text-light">✅ Nenhuma notificação nova.</p>
                @endforelse
            </div>

            <!-- Rodapé -->
            <div class="modal-footer bg-dark">
                <form action="{{ route('usuario.notificacao') }}" method="POST" class="me-auto">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check2-square me-1"></i> Marcar como lidas
                    </button>
                </form>
                
                <form method="POST" action="{{ route('notificacao.destroy', Auth::user()->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger btn" title="Deletar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Fechar
                </button>
            </div>
        </div>
    </div>
</div>
