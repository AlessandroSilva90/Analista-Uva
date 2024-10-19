@extends('layout')

@section('content')
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    <div class="content m-2">

        <h2 class="text-5xl font-medium mb-4">Seus itens do carrinho:</h2>

        @if ($pedidos->isEmpty())
            <p>Você está sem produtos no carrinho</p>
        @else
            <ul>
                @foreach ($pedidos as $pedido)
                    <li>
                        <x-modais.card titulo="{{ $pedido->produto->nome }}" descricao="{{ $pedido->produto->descricao }}"
                            carrinhoId="{{ $pedido->id }}" fotoproduto="{{ $pedido->produto->foto_produto }} " valor="{{ $pedido->produto->preco_venda }} "  />
                @endforeach
                </li>
            </ul>


<div class="container flex flex-row w-full">


            <div class="total w-full">
                <label for="" class="form-label"><b>Valor total do carrinho:</b></label>
                <input type="text" value="{{ $totalFinal }}" disabled class="form-control text-black">
            </div>
            @if (session('totalFinal'))
            <label for="" class="form-label"><b>Valor total do carrinho com desconto:</b></label>
            : R$ {{ number_format(session('totalFinal'), 2, ',', '.') }}
            @endif

            <div class="cupom w-full">
                <form action="{{ route('cupom_desconto.store') }}" method="POST"
                    class="pl-8  text-black">
                    @csrf
                    <label for="CupomDescontro ">Cupom de desconto</label>
                    <div class="flex flex-row gap-3">
                        <input type="text" name="nm_cupom" id="nm_cupom" class="form-control max-w-4">
                        <button type="submit" class="btn btn-outline-success">Aplicar cupom</button>
                    </div>
                </form>
                {{-- <form action="{{ route('cupom_desconto.delete') }}" method="POST"
                    class="pl-8  text-black">
                    @csrf
                    <label for="CupomDescontro ">Cupom de desconto</label>
                    <div class="flex flex-row gap-3">
                        <input type="text" name="nm_cupom" id="nm_cupom" class="form-control max-w-4">
                        <button type="submit" class="btn btn-outline-danger">Remover Cupom Atual</button>
                    </div>
                </form> --}}
            </div>
        </div>

            <div class="endCompras ">
                <form action="{{ route('carrinho.finalizar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-success">Finalizar</button>
                </form>
            </div>
    </div>
    @endif
@endsection
