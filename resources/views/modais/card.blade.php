<div class="container row m-2">
    <div class="card mb-3 col-md-6" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('produtos_foto/' . $fotoproduto) }}" class="img-fluid rounded-start"
                    alt="{{ $fotoproduto }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><b>{{ $titulo }} </b></h5>
                    <p class="card-text">{{ $descricao }}</p>
                    <p class="card-text">R$:{{ $valor }}</p>
                </div>
            </div>
        </div>

    </div>
    <div class="options col-md-6">
        <form action="{{ route('carrinho.destroy', $carrinhoId) }}" method="POST" style="display:inline;">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-outline-danger">Excluir</button>
        </form>
    </div>
</div>
