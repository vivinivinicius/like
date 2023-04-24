<h3>Lista de Cursos</h3>
<a class="btn btn-outline-primary float-right" href="?p=curso/salvar">Add</a>
<br><br>
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
        include_once '../class/Curso.php';
        $cat = new Curso();
        $dados = $cat->consultar();
        
        if (!empty($dados)) {
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
        }
        ?>
    </tbody>
</table>