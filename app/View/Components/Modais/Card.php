<?php
namespace App\View\Components\Modais;

use Illuminate\View\Component;

class Card extends Component
{
    public $titulo;
    public $descricao;
    public $carrinhoId;
    public $fotoproduto;

    public function __construct($titulo, $descricao, $carrinhoId,$fotoproduto)
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->carrinhoId = $carrinhoId;
        $this->fotoproduto = $fotoproduto;
    }

    public function render()
    {
        return view('modais.card');
    }
}
