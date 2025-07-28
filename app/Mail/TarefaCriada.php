<?php

namespace App\Mail;

use App\Models\Tarefa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TarefaCriada extends Mailable
{
    use Queueable, SerializesModels;

    public $tarefa;

    public function __construct(Tarefa $tarefa)
    {
        // Garante que o relacionamento "usuario" esteja carregado
        $this->tarefa = $tarefa->load('usuario');
    }

    public function build()
    {
        return $this->subject('📋 Nova Tarefa Atribuída')
                    ->markdown('emails.tarefa_criada');
    }
}
