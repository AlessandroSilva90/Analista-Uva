@extends('layout')

@section('content')
    <h1 class="text-5xl font-medium mb-4">Lista de Categoria de produtos</h1>

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

    {{-- @if (auth()->check() && auth()->user()->is_admin) --}}
        <form method="POST" action="{{ route('categoria.store') }}">
            @csrf
            <label class="form-label" >Nome Categoria</label>
            <input type="text" class="form-control" placeholder="Digite o nome da categoria" id="nome" name="nome" >
            <button type="submit" class="btn-primary p-2 m-2 rounded  ">Adicionar Categoria</button>
        </form>
    {{-- @endif --}}

    {{-- Verificação para ver se há categorias --}}
    @if ($categorias->isEmpty())
        <div class="pt-4">
            <p>Nenhuma categoria cadastrada.</p>
        </div>
    @else
        <table border="1" class="table table-striped mt-2">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            @foreach ($categorias as $categoria)
                <tr class="column">
                    <td class="">{{ $categoria->id }}</td>
                    <td class="">{{ $categoria->name }}</td>
                    <td class="flex">
                        @if (auth()->check() && auth()->user()->is_admin)
                            {{-- <button class="btn btn-edit bg-blue-600 m-2" data-id="{{ $categoria->id }}"
                    data-nome="{{ $categoria->nome }}"
                    data-descricao="{{ $categoria->descricao }}"
                    data-preco_venda="{{ $categoria->preco_venda }}"
                    data-preco_compra="{{ $categoria->preco_compra }}"
                    data-foto_produto="">
                Editar
            </button> --}}
                            <form action="{{ route('categoria.destroy', $categoria) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-edit bg-red-600 m-2">Deletar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- @include('modais.editarProduto')
    @include('modais.inserirCarrinho') --}}
    @endif

@endsection
