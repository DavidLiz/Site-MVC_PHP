<?php

use app\Libraries\Connection;

class User{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new Connection;
    }
    
    /**
     * FUNÇÃO QUE VERIFICA A PRÉ-EXISTÊNCIA DO EMAIL NO BANCO DE DADOS (DEFAULT)
     * @param string $email
     * @return boolean
     */
    public function email_check($email){
        $this->pdo->query("SELECT email FROM usuarios WHERE email = :email");
        $this->pdo->bind(":email", $email);

        if($this->pdo->fetch()):
            return true;
        else:
            return false;
        endif;
    }
    

    /**
     * FUNÇÃO QUE VERIFICA A PRÉ-EXISTÊNCIA DO EMAIL NO BANCO DE DADOS (UPDATE)
     * @param string $email
     * @return boolean
     */
    public function email_check_update($email){
        $this->pdo->query("SELECT email FROM usuarios WHERE email = :email");    
        $this->pdo->bind("email", $email);
        $this->pdo->execute();

        if($this->pdo->rowCount() > 0){
            $email_recovery = $this->pdo->fetch();
            if($email == $email_recovery):
                return true;
            else:
                return false;
            endif;
        }else{
            return false;
        }
    }
    
        
    /**
     * FUNÇÃO QUE REGISTRA O USUÁRIO NO BANCO DE DADOS
     * @param array $data
     * @return boolean
     */
    public function register($data){

        // INSERÇÃO DOS DADOS E EXECUÇÃO DA QUERY 
        $this->pdo->query("INSERT INTO usuarios(nome, perfil, email, senha) VALUES(:nome, :perfil, :email, :senha)");
        $this->pdo->bind("nome", $data['nome']);
        $this->pdo->bind("email", $data['email']);
        $this->pdo->bind("senha", $data['senha']);
        $this->pdo->bind("perfil", $data['perfil']);
        if($this->pdo->execute()):
            return true;
        else:
            return false;
        endif;
    }

        
    /**
     * FUNÇÃO QUE VERIFICA SE O USUÁRIO EXISTE (LOGIN)
     * @param string $email
     * @param string $senha
     * @return array 
     */
    public function login($email, $senha){
        $this->pdo->query("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");    
        $this->pdo->bind("email", $email);
        $this->pdo->bind("senha", $senha);
        $this->pdo->execute();

        if($this->pdo->rowCount() > 0){
            $login = $this->pdo->fetch();
            return $login;
        }else{
            return false;
        }
    }
    

    /**
     * FUNÇÃO QUE CRIA A SESSÃO A PARTIR DO LOGIN DO USUÁRIO
     * @param array $login
     */
    public function session($login){  
        $_SESSION['user_logged'] = $login;
    }

        
    /**
     * FUNÇÃO QUE CRIA A SESSÃO DE PERMISSÃO DO USUÁRIO A PARTIR DO LOGIN
     * @param array $perfil
     */
    public function permission($perfil){
        $this->pdo->query("SELECT * FROM perfil WHERE nome = :nome"); 
        $this->pdo->bind("nome", $perfil);
        $this->pdo->execute();

        if($this->pdo->rowCount() > 0){
            $permission = $this->pdo->fetch();
            $_SESSION['permission'] = $permission;
        }else{
            $_SESSION['permission'] = false;
        }
    }   

        
    /**
     * FUNÇÃO QUE RECUPERA TODOS OS USUÁRIOS DO BANCO DE DADOS
     * @return boolean 
     */
    public function get(){
        $this->pdo->query("SELECT * FROM usuarios");
        return $this->pdo->fetchAll();
    }

    public function delete($data){
        $this->pdo->query("DELETE FROM usuarios WHERE id=:id");
        $this->pdo->bind("id", $data['id']);
        if($this->pdo->execute()):
            return true;
        else:
            return false;
        endif;
    }

        
    /**
     * FUNÇÃO QUE REALIZA O UPDATE DO USUÁRIO NO BANCO DE DADOS
     * @param array $data
     * @return boolean
     */
    public function update($data){
        $this->pdo->query("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, perfil = :perfil WHERE id=:id");

        $this->pdo->bind("id", $data['id']);
        $this->pdo->bind("nome", $data['nome']);
        $this->pdo->bind("email", $data['email']);
        $this->pdo->bind("senha", $data['senha']);
        $this->pdo->bind("perfil", $data['perfil']);

        if($this->pdo->execute()):
            return true;
        else:
            return false;
        endif;

    }


    /**
     * FUNÇÃO QUE BUSCA USUÁRIO PELO NOME
     * @param  mixed $nome
     */
    public function getByName($nome){
        $this->pdo->query("SELECT * FROM usuarios WHERE nome = :nome");
        $this->pdo->bind("nome", $nome);

        if($this->pdo->execute()):
            return $this->pdo->fetchAll();
        else:
            return false;
        endif;
    }
}