<?php
include_once '../class/Categoria.php';
$cat = new Categoria();
$dados = $cat->consultar();
?>

<h3>Cadastrar Produto</h3>
<a class="btn btn-outline-danger float-right" href="?p=produto/listar">Voltar</a>
<br><br>

<form method="post" enctype="multipart/form-data" name="frmCadastro" id="frmCadastro">

    <div class="form-group">
        <label for="exampleInputText">Nome</label>
        <input type="text" class="form-control" id="exampleInputText" placeholder="Informe o nome do produto" name="txtnome" value="">
    </div>
    <div class="form-group">
        <label for="exampleInputText">Categoria</label>
        <select class="form-control" id="selcategoria" name="selcategoria" required>
            <?php
            foreach ($dados as $mostrar) {
                echo '<option value="' . $mostrar[0] . '">' . $mostrar[1] . '</option>';
            }
            ?>
        </select>
    </div>

    <input type="submit" class="btn-btn-success" name="btnsalvar" value="Cadastrar" ;>
</form>
<?php
//se eu clicar no botão salvar
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $categoria = filter_input(INPUT_POST, 'selcategoria');
    include_once '../class/Produto.php';
    $prod = new Produto();
    $prod->setNome($nome);
    $prod->setId_categoria($categoria);

    if ($prod->salvar()) {
        echo '<div class="alert alert-success" role="alert>"' . "Salvo com sucesso" . '</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert>"' . "Erro ao salvar" . '</div>';
    }
}
