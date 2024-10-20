@extends('layout')

@section('content')
<h1 class="text-5xl font-medium mb-4">Lista de Produtos</h1>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
<script>
    alert("{{ session('error') }}");
</script>
@endif

@if(auth()->check() && auth()->user()->is_admin)
    <a href="{{ route('produtos.index') }}" class="btn-primary p-2 m-2 rounded  ">Adicionar Produto</a>
@endif

{{-- Verificação para ver se há produtos --}}
<table border="1" class="table table-striped mt-2">
    <tr>
        <th>Imagem</th>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Qtd Disponível</th>
        <th>Ações</th>
    </tr>
    @foreach($produtos as $produto)
    <tr class="column">
        <td class="col-md-2 m-auto"><img src="{{asset('produtos_foto/'.$produto->foto_produto)}}" alt="img_produto" class="img-fluid max-w-40 max-h-40"></td>
        <td class="col-md-2">{{ $produto->id }}</td>
        <td class="col-md-2">{{ $produto->nome }}</td>
        <td class="col-md-2">{{ $produto->descricao }}</td>
        <td class="col-md-2">{{ $produto->preco_venda }}</td>
        <td class="col-md-2">{{  $produto->estoque ? $produto->estoque->quantidade_disponivel : 0 }}</td>
        <td class="col-md-2 flex">
            @if( auth()->check() && auth()->user()->is_admin)

            <button class="btn btn-edit bg-blue-600" data-id="{{ $produto->id }}"
                data-nome="{{ $produto->nome }}"
                data-descricao="{{ $produto->descricao }}"
                data-preco_venda="{{ $produto->preco_venda }}"
                data-preco_compra="{{ $produto->preco_compra }}"
                data-foto_produto=""
                data-qtd_estoque="{{$produto->estoque ? $produto->estoque->quantidade_disponivel : 0}}"
                >

            Editar
        </button>
            <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display:inline;">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-edit bg-red-600">Deletar</button>
            </form>
            @endif
            <button id="btn-comprar" class="btn btn-comprar bg-green-600"
            data-id="{{ $produto->id }}"
            >Comprar</button>
        </td>
    </tr>
    @endforeach
</table>
@include('modais.editarProduto')
@include('modais.inserirCarrinho')


<script>
$(document).ready(function() {
    $('.btn-edit').on('click', function() {
        const produtoId = $(this).data('id');
        const produtoNome = $(this).data('nome');
        const produtoDescricao = $(this).data('descricao');
        const produtoPrecoVenda = $(this).data('preco_venda');
        const produtoPrecoCompra = $(this).data('preco_compra');
        const produtoFoto = $(this).data('foto_produto');
        const qtd_estoque = $(this).data('qtd_estoque');

        $('#editForm').attr('action', '/produtos/' + produtoId); // Atualiza a URL de ação
        $('#editNome').val(produtoNome);
        $('#editDescricao').val(produtoDescricao);
        $('#editPrecoVenda').val(produtoPrecoVenda);
        $('#editPrecoCompra').val(produtoPrecoCompra);
        $('#editFotoProduto').val(produtoFoto); // Não é possível preencher campos de arquivo
        $('#qtd_estoque').val(qtd_estoque);

        $('#editModal').modal('show');
    });
});

$(document).ready(function() {
    $('.btn-comprar').on('click', function() {
        const produtoId = $(this).data('id');
        $('#produtos_id').val(produtoId);
        $('#cadCompraComprador').modal('show');
    });
});
</script>
@endsection
