<?php
include_once '../class/Categoria.php';
$cat = new Categoria();
$dados = $cat->consultar();
?>


<h3>
    Cadastrar de Curso
</h3>
<a class="btn btn-outline-danger float-right" href="?p=produto/listar">Voltar</a>
<br><br>

<form method="post" enctype="multipart/form-data" name="frmCadastro" id="frmCadastro">

    <div class="form-group">
        <label for="exampleInputText">Nome</label>
        <input type="text" class="form-control" id="exampleInputText" placeholder="Informe o nome" name="txtnome"
            value="<?= isset($id) ? $nome : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">ID_Area</label>
        <select class="form-control" id="selcategoria" name="selcategoria" required>
            <?php
            foreach ($dados as $mostrar) {
                echo '<option value="' . $mostrar[0] . '">' . $mostrar[0] . '</option>';
            }
            ?>
        </select>
    </div>

    <input type="submit" class="btn btn-primary"
        name="btnsalvar" value="<?= isset($id) ? 'Editar' : 'Cadastrar' ?>">
</form>
<?php
//se eu clicar no botão salvar
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $area = filter_input(INPUT_POST, 'selcategoria');
    include_once '../class/Produto.php';
    $prod = new Produto();
    $prod->setNome($nome);
    $prod->setId_categoria($area);

    if ($prod->salvar()) {
        echo '<div class="alert alert-success" role="alert>"' . "Salvo com sucesso" . '</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert>"' . "Erro ao salvar" . '</div>';
    }
}


if (filter_input(INPUT_POST, 'btneditar')) {
    //capturei dados do form HTML para variáveis
    $nome = filter_input(INPUT_POST, 'txtnome');
    $id = filter_input(INPUT_POST, 'txtid');


    //enviar dados que capturei do form para class Categoria

    //efetivar o cadastro
    if ($cat->editar()) {
        echo '<div class="alert alert-success mt-3" role="alert">';
        echo 'Cadastro efetuado com sucesso';
        echo '</div>';

        echo '<meta http-equiv="refresh" content="0.5;URL=?p=curso/listar">';
    }
}
