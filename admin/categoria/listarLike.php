<h3>Lista de Categorias</h3>
<a class="btn btn-outline-primary float-right" href="?p=categoria/salvar">Add</a>
<br><br>

<div class="col-sm-12">
    <nav aria-label="..." class="mb-3">
        <ul class="pagination justify-content-center">
            <?php
            foreach (range('A', 'Z') as $mostrar) {
            ?>
                <li class="page-item">
                    <a href="?p=categoria/listarLike&letra=<?= $mostrar ?>" class="page-link">
                        <?= $mostrar ?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>
</div>

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
        $letra = filter_input(INPUT_GET, 'letra');
        include_once '../class/Categoria.php';
        $cat = new Categoria();
        $dados = $cat->consultarLike($letra);

        if ($dados) {
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
        } else {
            ?>
            <tr>
                <td colspan="3">
                    <div class="alert alert-danger" role="alert">
                        Nenhum registro encontrado
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>