<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';
    protected $fillable = [
        'id',
        'titulo',
        'descricao',
        'lida',
        'usuario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
