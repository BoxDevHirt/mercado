<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solicitacao extends Model
{
    protected $table = 'solicitacao';
    protected $fillable = [
        'name',
        'status',
    ];
}
