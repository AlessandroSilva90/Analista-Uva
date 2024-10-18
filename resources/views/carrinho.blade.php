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

        <h2>Seus itens do carrinho:</h2>
        @foreach ($pedidos as $pedido)
            <x-modais.card
            titulo="{{ $pedido->produto->nome }}"
            descricao="{{ $pedido->produto->descricao }}"
            carrinhoId="{{ $pedido->id }}"
            fotoproduto="{{ $pedido->produto->foto_produto }}" />
        @endforeach


        @if (session('totalFinal'))
            <p>Total com desconto: R$ {{ number_format(session('totalFinal'), 2, ',', '.') }}</p>
        @endif

        <div class="total">
            <input type="text" value="{{ $totalFinal }}">
        </div>
        <div class="endCompras">
            <form action="{{ route('carrinho.index') }}" method="POST">
                @csrf
                <label for="CupomDescontro">Cupom de desconto</label>
                <input type="text" name="nm_cupom" id="nm_cupom">
                <button type="submit" class="btn btn-outline-success">Finalizar</button>
            </form>
        </div>

    </div>
@endsection
