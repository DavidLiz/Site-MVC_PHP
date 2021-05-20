<?php 

namespace app\Libraries;

class Controller{
    
    /**
     * Método que trata o MODEL antes dele ser carregado
     * @param mixed $model
     */
    public function model($model){
        require_once '../app/Model/'.$model.'.php';
        return new $model;
    }
    
    /**
     * Método que trata a VIEW antes dela ser carregada
     * @param  mixed $view
     * @param  array $data
     */
    public function view($view, $data=[]){
        $archive = ('../app/View/'.$view.'.php');

        if(file_exists($archive)):
            require_once $archive;
        else:
            die('Página não encontrada!');
        endif;
    }
}