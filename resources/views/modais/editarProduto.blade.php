<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" id="editNome" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" class="form-control" id="editDescricao" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="preco_venda">Preço de Venda:</label>
                        <input type="text" name="preco_venda" class="form-control" id="editPrecoVenda" required>
                    </div>
                    <div class="form-group">
                        <label for="preco_compra">Preço de Compra:</label>
                        <input type="text" name="preco_compra" class="form-control" id="editPrecoCompra" required>
                    </div>
                    <div class="form-group">
                        <label for="qtd_estoque">Quantidade no estoque:</label>
                        <input type="number" name="qtd_estoque" class="form-control" id="qtd_estoque" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_produto">Foto do Produto:</label>
                        <input type="file" name="foto_produto" class="form-control" id="editFotoProduto">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>
