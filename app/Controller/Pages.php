<?php

use app\Libraries\Controller;

/**
 * CLASSE DE PÁGINAS
 */
class Pages extends Controller{
    public function __construct()
    {
        $this->projectModel = $this->model('Project');
    }
    
    /**
     * CONTROLADOR DA HOMEPAGE
     */
    public function index(){

        // VIEW
        $this->view('navbar');
        $this->view('pages/home');
        $this->view('pages/about');
        $this->view('pages/community');
        $this->view('pages/contact');
        $this->view('footer');
    }
    
    /**
     * CONTROLADOR DA PÁGINA DE PROJETOS
     * @return array $data
     */
    public function projects(){

        // LISTAGEM DE PROJETOS
        $data = [
            'projects' => $this->projectModel->get()
        ];
        
        // VIEW
        $this->view('navbar');
        $this->view('pages/projects', $data);
        $this->view('footer');
    }
}