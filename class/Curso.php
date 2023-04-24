<?php

include_once 'Conectar.php';

class Curso {

    private $id;
    private $nome;
    private $duracao;
    private $con;
    private $caminho = "../img/curso/";
    private $imagem;
    private $temp_imagem;
    private $control;

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
  

    function getId() {
        return $this->id;
    }

    function getDuracao() {
        return $this->duracao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDuracao($duracao) {
        $this->duracao = $duracao;
    }
    public function getImagem() {
        return $this->imagem;
    }

    public function getTemp_imagem() {
        return $this->temp_imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setTemp_imagem($temp_imagem) {
        $this->temp_imagem = $temp_imagem;
    }

    function consultar() {
        try {
            //estabelece conexão com bd
            $this->con = new Conectar();
            //monta a string sql
            $sql = "SELECT * FROM curso";
            //faz a ligação entre a conexão com a string sql
            $ligacao = $this->con->prepare($sql);
            /*
             * faz um if ternário que verifica se a consulta foi executada == 1
             * se sim, retorna todos os registros da tabela fetchAll()
             * se não, retorna false
             */
            return $ligacao->execute() == 1 ? $ligacao->fetchAll() : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }
    function consultarLike($letra) {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM curso WHERE nome LIKE ? ORDER BY nome";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $letra . '%');

            return $ligacao->execute() == 1 ? $ligacao->fetchAll() : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }
    function consultarPorID() {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM curso WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->id);
            return $sql->execute() == 1 ? $sql->fetchAll() : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function salvar() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO curso VALUES (null, ?, ?)";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->nome);
            $sql->bindValue(2, $this->duracao);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function editar() {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE curso SET nome = ?, duracao = ? WHERE id  = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->nome);
            $sql->bindValue(2, $this->duracao);
            $sql->bindValue(3, $this->id);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }
    function enviarArquivos() {
        $this->control = new Controles();
        return $this->control->enviarArquivo(
                        $this->temp_imagem,
                        $this->caminho . $this->imagem,
                        "Enviar imagem de categoria");
    }

    function excluir(){
         try {
            $this->con = new Conectar();
            $sql = "DELETE FROM curso WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->id);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

   
}