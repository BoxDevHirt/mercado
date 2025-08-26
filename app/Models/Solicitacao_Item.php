<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solicitacao_Item extends Model
{
    protected $table = 'solicitacao_item';
    protected $fillable = [
        'type_request',
        'quantidade',
        'user_id',
        'solicitacao_id',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function solicitacao(): BelongsTo
    {
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id');
    }

    public function produtos(): BelongsTo
    {
        return $this->belongsTo(Cadastro_Solicitacao_Produtos::class, 'type_request');
    }
}
