<h3>Lista de Cursos</h3>
<a class="btn btn-outline-primary float-right" href="?p=curso/salvar">Add</a>
<br><br>

<div class="col-sm-12">
    <nav aria-label="..." class="mb-3">
        <ul class="pagination justify-content-center">
            <?php
            foreach (range('A', 'Z') as $mostrar) {
            ?>
                <li class="page-item">
                    <a href="?p=curso/listarLike&letra=<?= $mostrar ?>" class="page-link">
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
            <th scope="col">Nome</th>
            <th scope="col">Duração</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $letra = filter_input(INPUT_GET, 'letra');
        include_once '../class/Curso.php';
        $cat = new Curso();
        $dados = $cat->consultarLike($letra);

        if ($dados) {
            foreach ($dados as $mostrar) {
        ?>
                <tr>
                    <th scope="row"><?= $mostrar['id'] ?></th>
                    <td><?= $mostrar['nome'] ?></td>
                    <td><?= $mostrar['duracao'] ?></td>
                    <td>
                        <a href="?p=curso/salvar&id=<?= $mostrar['id'] ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=curso/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?">
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