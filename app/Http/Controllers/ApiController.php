<?php

namespace App\Http\Controllers;

use App\Services\ProdutosUserService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $carrinhoService;

    public function __construct(ProdutosUserService $carrinhoService)
    {
        $this->carrinhoService = $carrinhoService;
    }

    public function index(Request $request)
    {
         $pedidos = $this->carrinhoService->obterPedidosDoCarrinho($request->token);

         return response()->json($pedidos);

    }
}
