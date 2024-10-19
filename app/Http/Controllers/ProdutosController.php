<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\produtos;
use App\Models\Estoque;
use App\Models\categoria;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $produtos = Produtos::with('estoque')->get();
        // return view('list_produtos',compact('produtos'));
        $categorias = categoria::all();
        return view('Produtos.cadastrar_produto_view',compact('categorias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'descricao'=>'required',
            'preco_venda'=>'required',
            'preco_compra'=>'required',
            'foto_produto'=>'required',
            'id_categoria'=>'required'
        ]);


        $produto_Existe = produtos::where('nome',$request->nome)->first();

        if($request->hasFile('foto_produto')){
            // Get filename with the extension
            $filenameWithExt = $request->file('foto_produto')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('foto_produto')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            // $path = $request->file('foto_produto')->storeAs('public/produtos_foto', $fileNameToStore);
            $request->foto_produto->move(public_path('produtos_foto'), $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.png';
        }

        if ($produto_Existe) {
            $estoque = Estoque::where('produto_id', $produto_Existe->id)->first();
            if ($estoque) {
                // Atualiza a quantidade disponível
                $estoque->quantidade_disponivel += $request->qtd_estoque;
                $estoque->save();
            } else {
                // Se não houver entrada no estoque, cria uma nova
                Estoque::create([
                    'produto_id' => $produto_Existe->id,
                    'quantidade_disponivel' => $request->qtd_estoque,
                ]);
            }
        } else {
            // Cria um novo produto
            $produto = Produtos::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'preco_venda' => $request->preco_venda,
                'preco_compra' => $request->preco_compra,
                'foto_produto' => $fileNameToStore,
                'id_categoria'=>$request->id_categoria
            ]);

            // Cria a entrada no estoque para o novo produto
            Estoque::create([
                'produto_id' => $produto->id,
                'quantidade_disponivel' => $request->qtd_estoque,
            ]);
        }

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');

    }

    public function produtos_list()
    {
        $produtos = Produtos::with('estoque')->
        with('categoria')->get();

        return view('Produtos/list_produtos',compact('produtos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validação dos dados de entrada
    $request->validate([
        'nome' => 'required',
        'descricao' => 'required',
        'preco_venda' => 'required|numeric',
        'preco_compra' => 'required|numeric',
        'foto_produto' => 'nullable|image',
        'qtd_estoque' => 'required|numeric',
    ]);
    try {
        $produto = Produtos::findOrFail($id);
    } catch (\Exception $e) {
        return redirect()->route('produtos.index')->with('error', 'Produto não encontrado.');
    }

    // Verifica se uma nova imagem foi enviada
    if ($request->hasFile('foto_produto')) {

        $filenameWithExt = $request->file('foto_produto')->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('foto_produto')->getClientOriginalExtension();

        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Tenta mover a imagem para o diretório
        try {
            $request->foto_produto->move(public_path('produtos_foto'), $fileNameToStore);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao fazer upload da imagem: ' . $e->getMessage());
        }

        // Remove a imagem antiga, se houver
        if ($produto->foto_produto && $produto->foto_produto != 'noimage.png') {
            $oldImagePath = public_path('produtos_foto/' . $produto->foto_produto);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Deleta a imagem antiga
            }
        }

        // Atualiza o nome da nova imagem no banco de dados
        $produto->foto_produto = $fileNameToStore;
    }

    // Atualiza os outros dados do produto
    try {
        $produto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco_venda' => $request->preco_venda,
            'preco_compra' => $request->preco_compra,
            // A foto só será atualizada se um novo arquivo for enviado
        ]);

        $estoque = Estoque::where('produto_id', $produto->id)->first();
        if ($estoque) {
            // Atualiza a quantidade disponível
            $estoque->quantidade_disponivel += $request->qtd_estoque;
            $estoque->save();
        } else {
            // Se não houver entrada no estoque, cria uma nova
            Estoque::create([
                'produto_id' => $produto->id,
                'quantidade_disponivel' => $request->qtd_estoque,
            ]);
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erro ao atualizar o produto: ' . $e->getMessage());
    }

    return redirect()->route('produtos.list')->with('success', 'Produto atualizado com sucesso!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = ProdutoS::findOrFail($id);
        $produto->delete($id);

        return redirect()->route('produtos.list')->with('success', 'Produto DELETADO com sucesso!');
    }
}
