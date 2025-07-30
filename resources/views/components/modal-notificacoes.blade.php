<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" aria-labelledby="TituloModalCentralizado"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Notificações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                @forelse ($notificacoes as $notificacao)
                    <div class="mb-3 p-3 border rounded bg-light">
                        <strong class="text-primary">📌 {{$notificacao['titulo'] }}</strong><br>
                        <span>{{ $notificacao['descricao']}}</span><br>
                        <span class="text-muted small">Recebida em: {{ \Carbon\Carbon::parse($notificacao['created_at'])->format('d/m/Y') }} </span>

                    </div>
                @empty
                    <p class="text-center text-muted">✅ Nenhuma notificação nova.</p>
                @endforelse
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                <form action="{{ route('usuario.notificacao')}} " method="POST">
                    @csrf
                <button type="submit" class="btn btn-primary">Marcar como lidas</button>
                </form>
            </div>

        </div>
    </div>
</div>
