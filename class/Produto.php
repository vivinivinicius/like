<?php

include_once 'Conectar.php';

class Produto {
 private $id;
 private $nome;
 private $id_categoria;
 private $con;
 
 
    

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getNome() {
		return $this->nome;
	}
	
	/**
	 * @param mixed $nome 
	 * @return self
	 */
	public function setNome($nome): self {
		$this->nome = $nome;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getId_categoria() {
		return $this->id_categoria;
	}
	
	/**
	 * @param mixed $id_categoria 
	 * @return self
	 */
	public function setId_categoria($id_categoria): self {
		$this->id_categoria = $id_categoria;
		return $this;
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
    
}