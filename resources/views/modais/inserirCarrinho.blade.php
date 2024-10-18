<!-- Modal -->
<div class="modal fade" id="cadCompraComprador" tabindex="-1" role="dialog" aria-labelledby="cadCompraComprador" aria-hidden="true">0
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Informações para compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="compradorForm" action="{{route('carrinho.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome Comprador:</label>
                        <input type="text" name="nome" class="form-control" id="nomeComprador" required>
                    </div>
                    <div class="form-group">
                    <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" class="form-control" id="cpf" required>
                    </div>
                    <div class="form-group">
                    <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" class="form-control" id="telefone" required>
                    </div>
                    <div class="form-group">
                    <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    {{-- campo escondido do id do produto --}}
                    <input type="hidden" name="produtos_id"  id="produtos_id" value="{{ $produto->id }}">
                    {{-- fim do campo escondido --}}

                    <button type="submit" class="btn btn-primary">Adicionar ao carrinho</button>
                </form>
            </div>
        </div>
    </div>
</div>
