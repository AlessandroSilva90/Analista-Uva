@extends('layout')

@if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@section('content')
    <h1 class="text-5xl font-medium">Cadastrar Produtos</h1>

    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="nome" class="form-control" id="nome" name="nome">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao">
        </div>
        <div class="mb-3">
            <label for="preco_venda" class="form-label">Preco de Venda</label>
            <input type="number" class="form-control" id="preco_venda" name="preco_venda">
        </div>
        <div class="mb-3">
            <label for="preco_compra" class="form-label">Preco de Compra</label>
            <input type="number" class="form-control" id="preco_compra" name="preco_compra">
        </div>
        <div class="mb-3">
            <label for="foto_produto" class="form-label">Foto do produto</label>
            <input type="file" class="form-control" id="foto_produto" name="foto_produto">
        </div>

        <div class="mb-3">
            <label for="qtd_estoque" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="qtd_estoque" name="qtd_estoque">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
