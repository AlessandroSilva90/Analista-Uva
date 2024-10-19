<?php

namespace App\Services;

use App\Models\Carrinho;
use App\Models\produtosCarrinho;
use Illuminate\Support\Facades\Auth;

class ProdutosUserService
{
    public function obterPedidosDoCarrinho($token=null)
    {
        $userId = null;

        if($token != null){
            $carrinho = Carrinho::where('token',$token)
            ->first();
        }else{
            $userId = Auth::user()->id;
            $carrinho = Carrinho::where('id_usuario', $userId)
                ->where('status','Aguardando')->first();
        }

        if (!$carrinho) {
            return collect(); // Retorna uma coleção vazia se não houver carrinho
        }

        $produtos = produtosCarrinho::with('produto')->where('carrinho_id', $carrinho->id)->get();

        return [
            'carrinho' => $carrinho,
            'produtos' => $produtos,
        ];

        // return produtosCarrinho::with('produto')->where('carrinho_id', $carrinho->id)->get();
    }
}
