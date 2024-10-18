<?php

namespace App\Http\Controllers;

use App\Jobs\FinalizarCompraJob;
use App\Services\ProdutosUserService;
use Illuminate\Http\Request;
use App\Models\Carrinho;
use App\Models\Estoque;
use App\Models\produtosCarrinho;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CarrinhoController extends Controller
{

     protected $carrinhoService;

    public function __construct(ProdutosUserService $carrinhoService)
    {
        $this->carrinhoService = $carrinhoService;
    }

    // Utilizei a index para fazer a aplicação do desconto
    public function index()
    {
        // $user  = Auth::user()->id;
        // $carrinho = carrinho::where('id_usuario',$user)->first();

        // $pedidos = pedido_carrinho::with('produto')->where('carrinho_id', $carrinho['id'])->get();
        $pedidos = $this->carrinhoService->obterPedidosDoCarrinho();

        $totalFinal = 0;
        foreach ($pedidos as $pedido) { //percorrer para acessar o produto
            $totalFinal += $pedido->produto->preco_venda ; // Calcula o total
        }

        // foreach ($pedidos as $pedido) {
        //     dd($pedido->produto->foto_produto); // Acessa a descrição do produto de cada pedido
        // }

        return view('carrinho',compact('pedidos','totalFinal'));
    }
    public function store(Request $request)
    {

        $validar_pedido = $request->validate([
            'produtos_id' => 'required|exists:produtos,id', // Verifica se o produto existe
            'nome' =>'required',
            'email' => 'required',
            'cpf' => 'required',
            ]);


        $usuario = User::firstOrCreate(
            [
                'email' => $validar_pedido['email'],
            ],
            [
                'name' => $validar_pedido['nome'],
                'cpf' =>$validar_pedido['cpf'],
            ]
        );

        $criar_carrinho = carrinho::firstOrCreate(
            [
                'id_usuario' => $usuario->id, // Condição de busca
                'status' => 'Aguardando' // Condição de busca
            ]
            );

        $estoque = Estoque::where('produto_id', $validar_pedido['produtos_id'])->first();

        if (!$estoque || $estoque->quantidade_disponivel <= 0) {
            return redirect()->route('produtos.list')->with('error', 'Produto fora de estoque.');
        }

        try {
            // Inserção dos dados no banco
            $pedido_carrinho = produtosCarrinho::create([
                'carrinho_id' => $criar_carrinho->id,
                'produtos_id' => $validar_pedido['produtos_id']
            ]);

            $estoque->quantidade_disponivel -= 1; // Ajuste se necessário para mais de um item
            $estoque->save();


            // Redireciona com mensagem de sucesso
            return redirect()->route('produtos.list')->with('success', 'Produto adicionado no carrinho com sucesso! '. $validar_pedido['produtos_id']);
        } catch (\Exception $e) {

            // Redireciona com mensagem de erro
            return redirect()->route('produtos.list')->with('error', 'Erro ao adicionar produto no carrinho. Tente novamente.'. $validar_pedido['produtos_id']);
        }


    }

    public function finaliza_compras(){
        $user  = Auth::user() ;
        $carrinho = carrinho::where('id_usuario',$user->id)->first();

        $token = Str::random(40);
        $carrinho->token = $token;
        $carrinho->status = 'Comprado'; // Atualiza o status se necessário
        $carrinho->save();

        $pedidos = produtosCarrinho::with('produto')->where('carrinho_id', $carrinho['id'])->get();

       FinalizarCompraJob::dispatch($user,$pedidos,$token);

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }

    public function destroy(string $id)
    {
        $produto = produtosCarrinho::findOrFail($id);
        $produto->delete($id);

        return redirect()->route('produtos.list')->with('success', 'Item DELETADO com sucesso!');
    }
}
