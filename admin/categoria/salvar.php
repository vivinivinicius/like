<!--admin/categoria/salvar.php-->

<?php

//capturar o id da URL
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Categoria.php';
$cat = new Categoria();

if(isset($id)){
    $cat->setId($id);
    $dados = $cat->consultarPorID();
    foreach ($dados as $mostrar){
        $descricao = $mostrar['descricao'];
        $ramal = $mostrar['ramal'];

    }
}




?>

<h3><?= isset($id) ? 'Editar' : 'Cadastrar' ?> de Categoria</h3>
<a class="btn btn-outline-danger float-right" href="?p=categoria/listar">Voltar</a>
<br><br>

<form method="post" enctype="multipart/form-data" name="frmCadastro" id="frmCadastro">

    <div class="form-group">
        <label for="exampleInputText">Descrição</label>
        <input type="text" class="form-control" id="exampleInputText" placeholder="Informe a descrição da categoria" name="txtdescricao" value="<?= isset($id) ? $descricao : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">Ramal</label>
        <input type="number" class="form-control" id="exampleInputText" name="txtramal" value="<?= isset($id) ? $ramal : '' ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputText">Imagem</label>
        <input type="file" class="form-control" id="exampleInputText" name="file_imagem">
    </div>
     





    <input type="submit" class="btn btn-<?= isset($id) ? 'success' : 'primary' ?>" name ="<?= isset($id) ? 'btneditar' : 'btnsalvar' ?>" value="<?= isset($id) ? 'Editar' : 'Cadastrar' ?>">
</form>
<?php
//se eu clicar no botão salvar
if (filter_input(INPUT_POST, 'btnsalvar')) {
    //capturei dados do form HTML para variáveis
    $descricao = filter_input(INPUT_POST, 'txtdescricao');
    $ramal = filter_input(INPUT_POST, 'txtramal');

    $imagem = $_FILES['file_imagem'];
    $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));

    if(strstr('png', $extensao) || strstr('jpg', $extensao)) {
        $novoNome = sha1(uniqid(time())) . "." . $extensao;
        $cat->setImagem($novoNome);
        $cat->setTemp_imagem($imagem['tmp_name']);
        $cat->enviarArquivos();
        $cat->salvar();

    }
  

    //enviar dados que capturei do form para class Categoria
    $cat->setDescricao($descricao);
    $cat->setRamal($ramal);

    //efetivar o cadastro
    if ($cat->salvar()){
        echo '<div class="alert alert-primary mt-3" role="alert>"';
        echo 'Cadastro efetuado com sucesso';
        echo '</div>';

        echo '<meta http-equiv="refresh" content="0.5; URL=?p=categoria/listar">';
    }
}

if (filter_input(INPUT_POST, 'btneditar')) {
    //capturei dados do form HTML para variáveis
    $descricao = filter_input(INPUT_POST, 'txtdescricao');
    $ramal = filter_input(INPUT_POST, 'txtramal');
  

    //enviar dados que capturei do form para class Categoria
    $cat->setDescricao($descricao);
    $cat->setRamal($ramal);

    //efetivar o cadastro
    if ($cat->editar()){
        echo '<div class="alert alert-success mt-3" role="alert">';
        echo 'Cadastro efetuado com sucesso';
        echo '</div>';
        
        echo '<meta http-equiv="refresh" content="0.5;URL=?p=categoria/listar">';
    }
}