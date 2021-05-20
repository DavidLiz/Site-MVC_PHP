<?php

use app\Libraries\Connection;

class Project{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new Connection;
    }
    
    
    /**
     * FUNÇÃO QUE RECUPERA TODOS OS PROJETOS DO BANCO DE DADOS
     * @return array
     */
    public function get(){
        $this->pdo->query("SELECT * FROM projetos ORDER BY id");
        return $this->pdo->fetchAll();
    }
    

    /**
     * FUNÇÃO QUE REGISTRAR O PROJETO NO BANCO DE DADOS
     * @param array $data
     * @return boolean
     */
    public function register($data){

        // INSERÇÃO DOS DADOS E EXECUÇÃO DA QUERY 
        $this->pdo->query("INSERT INTO projetos(titulo, descricao, valor, banner, criado_por) VALUES(:titulo, :descricao, :valor, :banner, :criado_por)");
        $this->pdo->bind("titulo", $data['titulo']);
        $this->pdo->bind("descricao", $data['descricao']);
        $this->pdo->bind("valor", $data['valor']);
        $this->pdo->bind("banner", $data['banner']);
        $this->pdo->bind("criado_por", $data['criado_por']);
        if($this->pdo->execute()):
            return true;
        else:
            return false;
        endif;
    }
    
    /**
     * FUNÇÃO QUE BUSCA O PROJETO PELO ID
     * @param integer $id
     * @return array
     */
    public function getId($id){
        $this->pdo->query("SELECT * FROM projetos WHERE id=$id");
        return $this->pdo->fetchAll();
    }
    
    
    /**
     * FUNÇÃO QUE REALIZA O UPDATE DO PROJETO NO BANCO DE DADOS
     * @param array $data
     * @return boolean
     */
    public function update($data){
        $this->pdo->query("UPDATE projetos SET titulo = :titulo, descricao = :descricao, valor = :valor, banner = :banner WHERE id=:id");

        $this->pdo->bind("id", $data['id']);
        $this->pdo->bind("titulo", $data['titulo']);
        $this->pdo->bind("descricao", $data['descricao']);
        $this->pdo->bind("valor", $data['valor']);
        $this->pdo->bind("banner", $data['banner']);

        if($this->pdo->execute()):
            return true;
        else:
            return false;
        endif;

    }
    

    /**
     * FUNÇÃO QUE REALIZA O DELETE DO PROJETO NO BANCO DE DADOS
     * @param array $data
     * @return boolean
     */
    public function delete($data){
        $this->pdo->query("DELETE FROM projetos WHERE id=:id");
        $this->pdo->bind("id", $data['id']);
        if($this->pdo->execute()):
            unlink($data['banner']);
            return true;
        else:
            return false;
        endif;
    }

        
    /**
     * FUNÇÃO QUE BUSCA O PROJETO PELO TÍTULO
     * @param string $titulo
     * @return boolean
     */
    public function getByName($titulo){
        $this->pdo->query("SELECT * FROM projetos WHERE titulo = :titulo");
        $this->pdo->bind("titulo", $titulo);

        if($this->pdo->execute()):
            return $this->pdo->fetchAll();
        else:
            return false;
        endif;
    }
}