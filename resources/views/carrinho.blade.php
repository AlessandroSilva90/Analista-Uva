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
        <ul>
            @foreach ($pedidos as $pedido)
                <li>
                    <x-modais.card titulo="{{ $pedido->produto->nome }}" descricao="{{ $pedido->produto->descricao }}"
                        carrinhoId="{{ $pedido->id }}" fotoproduto="{{ $pedido->produto->foto_produto }}" />
            @endforeach
            </li>
        </ul>


        @if (session('totalFinal'))
            <p>Total com desconto: R$ {{ number_format(session('totalFinal'), 2, ',', '.') }}</p>
        @endif

        <div class="total">
            <input type="text" value="{{ $totalFinal }}" disabled class="form-control text-black">
        </div>

        <div class="cupom">
            <form action="{{ route('cupom_desconto.store') }}" method="POST" class="p-8 m-8 bg-white max-w-20 text-black">
                @csrf
                <label for="CupomDescontro ">Cupom de desconto</label>
                <div class="flex flex-row w-1/2 gap-3">
                    <input type="text" name="nm_cupom" id="nm_cupom" class="form-control max-w-4">
                    <button type="submit" class="btn btn-outline-success">Aplicar cupom</button>

                </div>
            </form>
        </div>
        <div class="endCompras ">
            <form action="{{ route('carrinho.finalizar') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-success">Finalizar</button>
            </form>
        </div>

    </div>
@endsection
