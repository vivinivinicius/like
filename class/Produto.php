<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Produto {

    private $id;
    private $nome;
    private $preco;
    private $id_categoria;
    private $con;

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getId() {
        return $this->id;
    }
    function getId_categoria()
    {
        return $this->id_categoria;
    }

    function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
    function getPreco() {
        return $this->preco;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

  

    function consultar() {
        try {
            //estabelece conexão com bd
            $this->con = new Conectar();
            //monta a string sql
            $sql = "SELECT * FROM produto";
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
            $sql = "SELECT * FROM categoria WHERE Preco LIKE ? ORDER BY id";
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
            $sql = "INSERT INTO produto VALUES (null, ?, ?)";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->nome);
            $sql->bindValue(2, $this->id_categoria);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }
    function produtoLike($letra) {
        try {
            
            $this->con = new Conectar();
            $sql = "SELECT * FROM produto WHERE nome LIKE ? ORDER BY nome";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $letra . '%');
            return $ligacao->execute() == 1 ? $ligacao->fetchAll() : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    
    function excluir(){
         try {
            $this->con = new Conectar();
            $sql = "DELETE FROM produto WHERE id = ?";
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
            
            $sql = "SELECT * FROM produto WHERE id = ?";
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
            $sql = "UPDATE categoria SET Preco = ?, Nome = ? WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->preco);
            $sql->bindValue(2, $this->nome);
            $sql->bindValue(3, $this->id);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }
   
}
