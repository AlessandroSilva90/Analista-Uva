<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CupomDesconto;
use App\Models\produtosCarrinho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CupomDescontoController extends Controller
{
    public function store(Request $request)
    {
        $cupom = $request->validate([
            'nm_cupom' =>'required|string'
        ]);

        $cupom_details = CupomDesconto::where('nm_cupom', $cupom['nm_cupom'])->first();

        $user  = Auth::user()->id;
        $carrinho = Carrinho::where('id_usuario',$user)->first();

        $pedidos = produtosCarrinho::with('produto')->where('carrinho_id', $carrinho['id'])->get();

        // $total = $pedidos->sum(function ($pedido) {
        //     return $pedido->preco * $pedido->quantidade;
        // });
        $total = 0;
        foreach ($pedidos as $pedido) { //percorrer para acessar o produto
            $total += $pedido->produto->preco_venda ; // Calcula o total
        }

        $desconto = ($cupom_details->porc_desconto / 100) * $total;
        $totalFinal = $total - $desconto;

        return redirect()->route('carrinho.index')->with('totalFinal', $totalFinal)
        ->with('success', 'Cupom adicionado!');

    }


}
