<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $fillable = ['nome'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);

}
}
