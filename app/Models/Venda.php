<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $table = "venda";

    protected $fillable = [
        'sequence',
        'id_funcionario',
        'id_cliente',
        'id_produto',
        'qtd',
        'valor_unidade',
        'valor_total',
    ];
}
