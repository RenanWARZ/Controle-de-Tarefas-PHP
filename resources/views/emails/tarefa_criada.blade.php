@component('mail::message')
# 📋 Nova Tarefa Atribuída

**Usuário:** {{ $tarefa->usuario->name ?? 'Não atribuído' }}

**Tarefa:** {{ $tarefa->task }}

**Descrição:**
{{ $tarefa->descricao }}

**Prazo:** {{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }}

**Prazo Final:** {{ \Carbon\Carbon::parse($tarefa->prazofinal)->format('d/m/Y') }}

@component('mail::button', ['url' => route('tarefas.index', ['usuario' => $tarefa->usuario->id ?? 0])])
📝 Ver Tarefas
@endcomponent

*Esta tarefa foi atribuída automaticamente pelo sistema.*

@endcomponent
