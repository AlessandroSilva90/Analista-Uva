<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = categoria::all();
        return view('categoria/cad-categoria',compact('categorias'));
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
        $categoria = categoria::firstOrCreate(
            ['name'=>$request->nome]
        );

        if($categoria){
            return redirect()->route('categoria.index')->with('success', 'Categoria cadastrada com sucesso.');
        }else{
            return redirect()->route('categoria.index')->with('error', 'Erro no cadastro do produto');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = categoria::findOrFail($id);
        $produto->delete($id);


            return redirect()->route('categoria.index')->with('success', 'Categoria DELETADA com sucesso.');


    }
}
