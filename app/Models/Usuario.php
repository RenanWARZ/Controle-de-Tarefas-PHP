<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Troca de Model para Authenticatable
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'id_user',
        'setor_id',
        'foto',
        'tarefa_atribuida'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


public function tarefa()
{
    return $this->belongsToMany(Tarefa::class, 'tarefa_usuario', 'usuario_id', 'tarefa_id');
}

public function tarefas()
{
    return $this->hasMany(Tarefa::class, 'usuario_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}


    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }
}
