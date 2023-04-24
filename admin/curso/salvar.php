<!--admin/curso/salvar.php-->

<?php
//capturar o id da url
$id = filter_input(INPUT_GET, 'id');
//comunicação com class curso
include_once '../class/Curso.php';
$cat = new Curso();

/*
 * isset serve para verificar se a variável foi utilizada
 */
if (isset($id)) {
    $cat->setId($id);
    $dados = $cat->consultarPorID();
    foreach ($dados as $mostrar) {
        $nome = $mostrar['nome'];
        $duracao = $mostrar['duracao'];
    }
}
?>

<h3><?= isset($id) ? 'Editar' : 'Cadastrar' ?> curso</h3>
<a class="btn btn-outline-danger float-right" href="?p=curso/listar">Voltar</a>
<br><br>

<form method="post" enctype="multipart/form-data" name="frmCadastro" id="frmCadastro">

    <div class="form-group">
        <label for="exampleInputText">Nome</label>
        <input type="text" class="form-control" id="exampleInputText" placeholder="Informe a descrição da curso" name="txtnome" value="<?= isset($id) ? $nome : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">duracao</label>
        <input type="number" class="form-control" id="exampleInputText" name="txtduracao" value="<?= isset($id) ? $duracao : '' ?>">
    </div>
    <input type="submit" class="btn btn-<?= isset($id) ? 'success' : 'primary' ?>" name="<?= isset($id) ? 'btneditar' : 'btnsalvar' ?>" value="<?= isset($id) ? 'Editar' : 'Cadastrar' ?>">
</form>
<?php
//se eu clicar no botão salvar
if (filter_input(INPUT_POST, 'btnsalvar')) {
    //capturei dados do form HTML para variáveis
    $nome = filter_input(INPUT_POST, 'txtnome');
    $duracao = filter_input(INPUT_POST, 'txtduracao');

    //enviar dados que capturei do form para class curso
    $cat->setnome($nome);
    $cat->setduracao($duracao);

    //efetivar o cadastro
    if ($cat->salvar()) {
        echo '<div class="alert alert-primary mt-3" role="alert>"';
        echo 'Cadastro efetuado com sucesso';
        echo '</div>';

        echo '<meta http-equiv="refresh" content="0.5;URL=?p=curso/listar">';
    }
}

if (filter_input(INPUT_POST, 'btneditar')) {
    //capturei dados do form HTML para variáveis
    $nome = filter_input(INPUT_POST, 'txtnome');
    $duracao = filter_input(INPUT_POST, 'txtduracao');

    //enviar dados que capturei do form para class curso
    $cat->setnome($nome);
    $cat->setduracao($duracao);

    //efetivar o cadastro
    if ($cat->editar()) {
        echo '<div class="alert alert-success mt-3" role="alert>"';
        echo 'Cadastro efetuado com sucesso';
        echo '</div>';

        echo '<meta http-equiv="refresh" content="0.5;URL=?p=curso/listar">';
    }
}