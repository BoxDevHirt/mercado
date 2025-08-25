<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadastro_Solicitacao_Produtos extends Model
{
    protected $table = 'cadastro_solicitacao_produtos';
    protected $fillable = [
        'name',
    ];
}
