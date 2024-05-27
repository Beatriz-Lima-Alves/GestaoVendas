<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalVendas extends Model
{
    use HasFactory;
    protected $fillable = [
        'sequence_venda',
        'total_venda',
        'tipo_pagamento',
    ];
}
