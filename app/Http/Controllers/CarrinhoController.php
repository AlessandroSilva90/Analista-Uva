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

    public function index()
    {

        // Acessando os produtos do carrinho do usuário com a service obterPedidosDoCarrinho
        $pedidos = $this->carrinhoService->obterPedidosDoCarrinho();

        $totalFinal = 0;
        foreach ($pedidos as $pedido) { //percorrer para acessar o produto
            $totalFinal += $pedido->produto->preco_venda; // Calcula o total
        }

        // foreach ($pedidos as $pedido) {
        //     dd($pedido->produto->foto_produto); // Acessa a descrição do produto de cada pedido
        // }

        return view('carrinho', compact('pedidos', 'totalFinal'));
    }
    public function store(Request $request)
    {

        $validar_pedido = $request->validate([
            'produtos_id' => 'required|exists:produtos,id', // Verifica se o produto existe
            'nome' => 'required',
            'email' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
        ]);


        $usuario = User::firstOrCreate( // Verificar se existe o usuario ou se cria um novo
            [
                'email' => $validar_pedido['email'],
            ],
            [
                'name' => $validar_pedido['nome'],
                'cpf' => $validar_pedido['cpf'],
                'telefone' => $validar_pedido['telefone'],
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
            return redirect()->route('produtos.list')->with('success', 'Produto adicionado no carrinho com sucesso! ' . $validar_pedido['produtos_id']);
        } catch (\Exception $e) {

            // Redireciona com mensagem de erro
            return redirect()->route('produtos.list')->with('error', 'Erro ao adicionar produto no carrinho. Tente novamente.' . $validar_pedido['produtos_id']);
        }
    }

    public function finaliza_compras()
    {
        $user  = Auth::user();
        $carrinho = carrinho::where('id_usuario', $user->id)
        ->where('status','Aguardando')->first();

        $pedidos = produtosCarrinho::with('produto')->where('carrinho_id', $carrinho['id'])->get();

        try {
            // Gera o token e atualiza o status do carrinho
            $token = Str::random(40);
            $carrinho->token = $token;
            $carrinho->status = 'Comprado';
            $carrinho->save();

            // Despacha o job para finalizar a compra
            FinalizarCompraJob::dispatch($user, $pedidos, $token);

            return redirect()->route('carrinho.index')->with('success', 'Compra finalizada. Mensagem enviada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('carrinho.index')->with('error', 'Ocorreu um erro ao finalizar a compra. Tente novamente.');
        }



    }

    public function destroy(string $id)
    {
        $produto = produtosCarrinho::findOrFail($id);

        $estoque = Estoque::where('produto_id', $produto->produtos_id)->first();
        if ($estoque) {
            $estoque->quantidade_disponivel += 1;
            $estoque->save();
        }

        $produto->delete($id);


        return redirect()->route('produtos.list')->with('success', 'Item DELETADO com sucesso!');
    }
}
