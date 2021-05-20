<?php 

namespace app\Libraries;

use PDO;
use PDOException;

/**
 * Classe de conexão com banco de dados
 */
class Connection{
    
    /**
     * Servidor local
     * @var string
     */   
    public $localhost = "localhost";
     
    /**
     * Usuário do banco de dados
     * @var string
     */
    public $user = "root";
   
    /**
     * Senha do banco de dados
     * @var string
     */
    public $pass = "";
        
    /**
     * Nome do banco de dados
     * @var string
     */
    public $database = "aviii_desenvweb";

    /**
     * Conexão PDO
     * @var mixed
     */
    public $pdo; 
    
    /**
     * Statement
     * @var mixed
     */
    private $stmt;

    public function __construct()
    {
        // CONEXÃO PDO COM O BANCO DE DADOS (ORIENTADO A OBJETO)
        try{
            $this->pdo = new PDO("mysql:dbname=".$this->database."; host=" .$this->localhost, $this->user, $this->pass);
            $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      
        }catch(PDOException $error){
            echo "ERROR: ".$error -> getMessage();
            exit;
        }
    }
    
    /**
     * Prepara a Query
     * @param string $sql
     */
    public function query($sql){
        $this->stmt = $this->pdo->prepare($sql);
    }
    
    /**
     * Função que define os tipos para cada valor
     * @param  mixed $param
     * @param  mixed $value
     * @param  mixed $type
     */
    public function bind($param, $value, $type = null){
        if(is_null($type)):
            switch (true):
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            endswitch;
        endif;

        $this->stmt->bindValue($param, $value, $type);
    }
    
    /**
     * Função que executa o statement
     * @return mixed
     */
    public function execute(){
        return $this->stmt->execute();
    }
    
    /**
     * Função que retorna um resultado
     * @return mixed
     */
    public function fetch(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Função que retorna todos os resultados 
     * @return array
     */
    public function fetchAll(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Função que retorna o número de linhas afetadas
     * @return integer
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }
    
    /**
     * Função que retorna o último id inserido
     * @return integer
     */
    public function lastInsertId(){
        return $this->stmt->lastInsertId();
    }
}


