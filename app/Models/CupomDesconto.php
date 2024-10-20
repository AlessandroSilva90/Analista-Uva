<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CupomDesconto extends Model
{
    use HasFactory;

    protected $table = 'cupom_desconto';

    protected $fillable = [
        'nm_cupom',
        'porc_desconto'
    ];
}
