<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = ['task', 'descricao', 'prazo', 'prazofinal', 'usuario_id', 'concluida'];


    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'usuario_id'); // certifique-se da chave estrangeira
}

public function usuarios()
{
    return $this->belongsToMany(Usuario::class, 'tarefa_usuario', 'tarefa_id', 'usuario_id');
}


}
