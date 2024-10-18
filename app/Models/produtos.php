<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produtos extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco_venda',
        'preco_compra',
        'foto_produto'
    ];

    public function pedidos()
    {
        return $this->hasMany(produtosCarrinho::class, 'produtos_id');
    }

    public function estoque(){
        return $this->hasOne(estoque::class,'produto_id');
    }
}
