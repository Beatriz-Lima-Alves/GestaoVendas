<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventosEstoque extends Model
{
    use HasFactory;
    protected $table = "eventos_estoque";

    protected $fillable = [
        'id_estoque',
        'qtd',
        'tipo',
    ];
}
