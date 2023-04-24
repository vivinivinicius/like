<?php
//capturar o id da url
$id = filter_input(INPUT_GET, 'id');
//comunicação com class curso
include_once '../class/Professor.php';
$cat = new Professor();

/*
 * isset serve para verificar se a variável foi utilizada
 */
if (isset($id)) {
    $cat->setId($id);
    $dados = $cat->consultarPorID();
    foreach ($dados as $mostrar) {
        $nome = $mostrar['nome'];
        $email = $mostrar['email'];
        $area = $mostrar['area'];
    }
}
?>

<h3><?= isset($id) ? 'Editar' : 'Cadastrar' ?> Professor</h3>
<a class="btn btn-outline-danger float-right" href="?p=professor/listar">Voltar</a>
<br><br>

<form method="post" enctype="multipart/form-data" name="frmCadastro" id="frmCadastro">

    <div class="form-group">
        <label for="exampleInputText">Nome</label>
        <input type="text" class="form-control" id="exampleInputText" placeholder="Informe a descrição do professor" name="txtnomee" value="<?= isset($id) ? $nome : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">Email</label>
        <input type="text" class="form-control" id="exampleInputText" name="txtemaill" value="<?= isset($id) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">Area</label>
        <input type="text" class="form-control" id="exampleInputText" name="txtareaa" value="<?= isset($id) ? $area : '' ?>">
    </div>
    <input type="submit" class="btn btn-<?= isset($id) ? 'success' : 'primary' ?>" name="<?= isset($id) ? 'btneditar' : 'btnsalvar' ?>" value="<?= isset($id) ? 'Editar' : 'Cadastrar' ?>">
</form>
<?php
//se eu clicar no botão salvar
if (filter_input(INPUT_POST, 'btnsalvar')) {
    //capturei dados do form HTML para variáveis
    $nome = filter_input(INPUT_POST, 'txtnomee');
    $email = filter_input(INPUT_POST, 'txtemaill');
    $area = filter_input(INPUT_POST, 'txtareaa');

    //enviar dados que capturei do form para class curso
    $cat->setNome($nome);
    $cat->setEmail($email);
    $cat->setArea($area);

    //efetivar o cadastro
    if ($cat->salvar()) {
        echo '<div class="alert alert-primary mt-3" role="alert>"';
        echo 'Cadastro efetuado com sucesso';
        echo '</div>';

        echo '<meta http-equiv="refresh" content="0.5;URL=?p=professor/listar">';
    }
}

if (filter_input(INPUT_POST, 'btneditar')) {
    //capturei dados do form HTML para variáveis
    $nome = filter_input(INPUT_POST, 'txtnomee');
    $email = filter_input(INPUT_POST, 'txtemaill');
    $area = filter_input(INPUT_POST, 'txtareaa');

    //enviar dados que capturei do form para class curso
    $cat->setNome($nome);
    $cat->setEmail($email);
    $cat->setArea($area);

    //efetivar o cadastro
    if ($cat->editar()) {
        echo '<div class="alert alert-success mt-3" role="alert>"';
        echo 'Cadastro efetuado com sucesso';
        echo '</div>';

        echo '<meta http-equiv="refresh" content="0.5;URL=?p=professor/listar">';
    }
}