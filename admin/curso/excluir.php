<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Curso.php';
$cat = new Curso();
$cat->setId($id);

if ($cat->excluir()) {
    ?>
    <div class="alert alert-primary" role="alert">
        Excluído com sucesso
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        Erro ao excluir.
    </div>
    <?php
}
?>
<meta http-equiv="refresh" content="1;URL=?p=curso/listar">