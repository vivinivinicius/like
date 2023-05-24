<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Area
{
    private $id;

    private $nome;

    private $con;

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO area VALUES (null, ?)";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->nome);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }

    function consultar()
    {
        try {
            //estabelece conexão com bd
            $this->con = new Conectar();
            //monta a string sql
            $sql = "SELECT * FROM area";
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

    function excluir()
    {
        try {
            $this->con = new Conectar();
            $sql = "DELETE FROM area WHERE id = ?";
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

            $sql = "SELECT * FROM area WHERE id = ?";
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
            $sql = "UPDATE nome SET nome  = ? WHERE id = ?";
            $sql = $this->con->prepare($sql);
            $sql->bindValue(1, $this->nome);
            $sql->bindValue(2, $this->id);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro de bd " . $exc->getMessage();
        }
    }
}