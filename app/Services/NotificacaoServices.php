<?php

namespace App\Services;

use App\Models\Notificacao;

class NotificacaoServices
{
    public $user;
    public $titulo;
    public $descricao;

    public function __construct($user, $titulo, $descricao)
    {
        $this->user = $user;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
    }

    public function cadastrarNotificacao()
    {

        try {
            $retorno = Notificacao::create([
                'usuario_id' => $this->user,
                'titulo' => $this->titulo,
                'descricao' => $this->descricao,
                'lida' => false,
                ])->usuario_id;

            } catch (\Throwable $th) {

        }
    }
}
