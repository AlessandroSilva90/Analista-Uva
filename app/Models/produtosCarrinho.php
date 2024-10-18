<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produtosCarrinho extends Model
{
    use HasFactory;

    protected $table = 'produtos_carrinho';

     protected $fillable = [
        'carrinho_id',
        'produtos_id',// Certifique-se de que todos os campos estão aqui
    ];

    public function produto()
    {
        return $this->belongsTo(produtos::class, 'produtos_id');
    }
}
