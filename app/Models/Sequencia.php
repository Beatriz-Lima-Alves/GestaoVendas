<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequencia extends Model
{
    use HasFactory;
    protected $table = "sequencia";

    protected $fillable = [
        'sequence',
    ];
}
