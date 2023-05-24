<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Categoria {

    private $id;
    private $descricao;
    private $ramal;
    private $con;

    private $caminho = "../img/categoria/";
    private $imagem;
    private $temp_imagem;
    private $control;

    function getRamal() {
        return $this->ramal;
    }

    function setRamal($ramal) {
        $this->ramal = $ramal;
    }

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }
     
    function getTemp_imagem() {
        return $this->temp_imagem;
    }

    function setTemp_imagem($temp_imagem) {
        $this->temp_imagem = $temp_imagem;
    }


    function consultar() {
        try {
            //estabelece conexão com bd
            $this->con = new Conectar();
            //monta a string sql
            $sql = "SELECT * FROM categoria";
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
            $sql = "SELECT * FROM categoria WHERE descricao LIKE ? ORDER BY descricao";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $letra . '%');
            return $ligacao->execute() == 1 ? $ligacao->fetchAll() : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function salvar() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO categoria VALUES (null, ?, ?, ?)";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->descricao);
            $sql->bindValue(2, $this->ramal);
            $sql->bindValue(3, $this->imagem);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function enviarArquivos() {
        $this->control = new Controles();
        return $this->control->enviarArquivo(
            $this->temp_imagem, 
            $this->caminho.$this->imagem,
            "Enviar imagem da categoria");

    }
    
    function excluir(){
         try {
            $this->con = new Conectar();
            $sql = "DELETE FROM categoria WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->id);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function consultarPorID() {
        try {
            
            $this->con = new Conectar();
            
            $sql = "SELECT * FROM categoria WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->id);

            
            return $sql->execute() == 1 ? $sql->fetchAll() : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function editar() {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE categoria SET descricao = ?, ramal = ? WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->descricao);
            $sql->bindValue(2, $this->ramal);
            $sql->bindValue(3, $this->id);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }
   
}
