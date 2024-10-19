<?php
namespace App\View\Components\Modais;

use Illuminate\View\Component;

class Card extends Component
{
    public $titulo;
    public $descricao;
    public $carrinhoId;
    public $fotoproduto;
    public $valor;

    public function __construct($titulo, $descricao, $carrinhoId,$fotoproduto,$valor)
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->carrinhoId = $carrinhoId;
        $this->fotoproduto = $fotoproduto;
        $this->valor = $valor;
    }

    public function render()
    {
        return view('modais.card');
    }
}
