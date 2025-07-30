<?php

namespace App\View\Components;

use App\Models\Notificacao;
use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalNotificacoes extends Component
{
    public $notificacoes;
    public function __construct($id)
    {
        $this->notificacoes = Notificacao::where('usuario_id', $id)->get()->toArray();
    }


    public function render(): View|Closure|string
    {
        return view('components.modal-notificacoes')->with([
            'notificacoes' => $this->notificacoes,
        ]);
    }
}
