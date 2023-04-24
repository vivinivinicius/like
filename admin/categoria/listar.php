<h3>Lista de Categorias</h3>
<a class="btn btn-outline-primary float-right" href="?p=categoria/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descrição</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/Categoria.php';
        $cat = new Categoria();
        $dados = $cat->consultar();
        
        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
                ?>
                <tr>
                    <th scope="row"><?= $mostrar['id'] ?></th>
                    <td><?= $mostrar['descricao'] ?></td>
                    <td>
                        <a href="?p=categoria/salvar&id=<?= $mostrar['id'] ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=categoria/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr> 
                <?php
            }
        }
        ?>
    </tbody>
</table>
