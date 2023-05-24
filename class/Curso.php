<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Curso
{

    private $id;
    private $nome;
    private $duracao;
    private $con;
    private $id_area;
  
    private $control;

    function getDuracao()
    {
        return $this->duracao;
    }

    function setDuracao($duracao)
    {
        $this->duracao = $duracao;
    }

    function getId()
    {
        return $this->id;
    }

    function getId_Area()
    {
        return $this->id_area;
    }

    function getNome()
    {
        return $this->nome;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setId_Area($id_area)
    {
        $this->id_area = $id_area;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    

    function consultar()
    {
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

    function consultarLike($letra)
    {
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


    function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO curso VALUES (null, ?, ?, ?)";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->nome);
            $sql->bindValue(2, $this->duracao);
            $sql->bindValue(3, $this->id_area);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function excluir()
    {
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

    function consultarPorID()
    {
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

    function editar()
    {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE curso SET nome = ?, duracao = ? WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->nome);
            $sql->bindValue(2, $this->duracao);
            $sql->bindValue(3, $this->id);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }


}
?>