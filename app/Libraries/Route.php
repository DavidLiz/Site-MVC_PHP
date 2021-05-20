<?php 

namespace app\Libraries;

/**
 * Realiza todo o tratamento das URLs, Controladores, Métodos e Parâmetros
 */
class Route{
    
    /**
     * Recupera o controlador
     * @var string
     */
    private $controller = 'Pages';
    
    /**
     * Recupera o método do controlador
     * @var string
     */
    private $method = 'index';
    
    /**
     * Parâmetros da URL
     * @var array
     */
    private $params = [];
    
    public function __construct()
    {
        $url = $this->url() ? $this->url() : [0];

        // VERIFICA SE O CONTROLADOR EXISTE
        if(file_exists('../app/Controller/'.ucwords($url[0]).'.php')):
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        endif;

        // REQUISITA O CONTROLADOR E O INSTANCIA
        require_once '../app/Controller/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        // VERIFICA SE O MÉTODO EXISTE DENTRO DO CONTROLADOR
        if(isset($url[1])):
            if(method_exists($this->controller, $url[1])):
                $this->method = $url[1];
                unset($url[1]);
            endif;
        endif;

        // VERIFICA SE EXISTE ALGUM PARÂMETRO NA URL E COMPARA COM A FUNÇÃO
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
        
    /**
     * Função que recupera e trata a URL
     * @return array
     */
    private function url(){

        // IMPEDE SQL INJECTION
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        
        // ELIMINA CARACTERES ESPECIAIS E ESPAÇOS EM BRANCO
        if(isset($url)):
            $url = trim(rtrim($url, '/'));
            $url = explode('/', $url);
            return $url;
        endif;
    }
}