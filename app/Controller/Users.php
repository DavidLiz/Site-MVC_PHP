<?php
use app\Helpers\Alerts;
use app\Libraries\Controller;
use app\Helpers\Validation;

class Users extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    } 
    
    /**
     * CONTROLADOR DA PÁGINA DE CADASTRO DE USUÁRIO
     * @return array $data
     */
    public function register(){
        if(!isset($_SESSION['user_logged'])):

            // RECEBIMENTO DO POST
            $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(isset($form)):
                $data = [
                    'nome' => trim($form['nome']),
                    'email' => trim($form['email']),
                    'senha' => trim($form['senha']),
                    'perfil' => "Usuario",
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => ''
                ];

                // VALIDAÇÃO
                if(in_array("", $form)):
                    if(empty($form['nome'])):
                        $data['nome_erro'] = "Preencha o campo nome";
                    endif;

                    if(empty($form['email'])):
                        $data['email_erro'] = "Preencha o campo email";
                    endif;

                    if(empty($form['senha'])):
                        $data['senha_erro'] = "Preencha o campo senha";   
                    endif;
                else:
                    if(Validation::validateName($form['nome'])):
                        $data['nome_erro'] = "Insira apenas caracteres alfabéticos";

                    elseif(Validation::validateEmail($form['email'])):
                        $data['email_erro'] = "Insira um email válido";

                    elseif($this->userModel->email_check($form['email'])):
                        $data['email_erro'] = "O email inserido já está cadastrado";

                    elseif(Validation::validatePass($form['senha'])): 
                        $data['senha_erro'] = "A senha deve ter no mínimo 8 caracteres";
                    else:
                        $data['senha'] = md5($form['senha']);
                        
                        // REALIZA O CADASTRO DO USUÁRIO NO BANCO DE DADOS
                        if($this->userModel->register($data)):
                            Alerts::alert('user', 'Cadastro realizado com sucesso!');
                            header('Location: '.URL.'/users/login');
                        else:
                            die('Falha ao cadastrar usuário');
                        endif;
                    endif;
                endif;
                
            else:
                $data = [
                    'nome' => '',
                    'email' => '',
                    'senha' => '',
                    'perfil' => '',
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => ''
                ];
            endif;

            // VIEW
            $this->view('users/register', $data);
        else:
            header("Location:".URL);
        endif;
    }

    
    /**
     * CONTROLADOR DA PÁGINA DE LOGIN
     * @return array $data
     */
    public function login(){
        if(!isset($_SESSION['user_logged'])):

            // RECEBIMENTO DO POST
            $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(isset($form)):
                $data=[
                    'email' => trim($form['email']),
                    'senha' => trim($form['senha']),
                    'email_erro' => '',
                    'senha_erro' => ''
                ];

                // VALIDAÇÃO
                if(in_array("", $form)):
                    if(empty($form['email'])):
                        $data['email_erro'] = "Preencha o campo email";
                    endif;

                    if(empty($form['senha'])):
                        $data['senha_erro'] = "Preencha o campo senha";   
                    endif;
                else:
                    if(Validation::validateEmail($form['email'])):
                        $data['email_erro'] = "Insira um email válido";

                    // REALIZA O LOGIN DO USUÁRIO    
                    else:
                        $login = $this->userModel->login($form['email'], md5($form['senha']));
                        if($login):

                            // CRIA AS SESSÕES NECESSÁRIAS
                            $this->userModel->session($login);
                            $this->userModel->permission($_SESSION['user_logged']->perfil);
                        header('Location: '.URL);
                        else:
                            Alerts::alert('user', 'Login inválido, tente novamente', 'alert alert-danger');
                        endif;
                    endif;
                endif;

            else:
                $data = [
                    'nome' => '',
                    'senha' => '',
                    'email_erro' => '',
                    'senha_erro' => ''
                ];
            endif;

            // VIEW
            $this->view('users/login', $data);
        else:
            header("Location:".URL);
        endif;
    }
    
    
    /**
     * FUNÇÃO DE LOGOUT 
     */
    public function logout(){
        if(isset($_SESSION['user_logged'])):
            
            // ESVAZIA A SESSÃO
            unset($_SESSION['user_logged']);
            unset($_SESSION['permission']);
            
            // DESTRÓI A SESSÃO
            session_destroy();
            header('Location: '.URL);
        else:
            header("Location:".URL);
        endif;
    }


    /**
     * CONTROLADOR DA PÁGINA DE LISTAGEM DE USUÁRIOS
     * @return array $data
     */
    public function setings(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id < 3):
                $data = [
                    'users' => $this->userModel->get()
                ];

                // VIEW
                $this->view('navbar');
                $this->view('users/setings', $data);
                $this->view('footer');
            else:
                header("Location:".URL);
            endif;
        else:
            header("Location:".URL);
        endif;
    }
    

    /**
     * FUNÇÃO QUE DELETA O USUÁRIO
     */
    public function delete(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id < 3):

                // RECEBIMENTO DO POST
                $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($form)):
                    $data = [
                        "id" => trim($form['id']),
                    ];
                    
                    // RESTRIÇÃO DE ACESSO
                    if($_SESSION['user_logged']->perfil < $form['perfil']): 
                        if($this->userModel->delete($data)):
                            Alerts::alert('user', 'Usuário excluído com sucesso!');
                            header('Location: '.URL.'/users/setings');
                        else:
                            die('Falha ao excluir usuário');
                        endif;
                    else:
                        Alerts::alert('user', 'Você não possui permissão para excluir esse usuário!', 'alert alert-danger');
                        header('Location: '.URL.'/users/setings');
                    endif;
                endif;

                // VIEW
                $this->view('navbar');
                $this->view('users/delete', $data);
                $this->view('footer');
            else:
                header("Location:".URL);
            endif;
        else:
            header("Location:".URL);
        endif;
    }

    
    /**
     * CONTROLADOR DA PÁGINA DE REGISTRO DE GERENTE DE COMUNIDADE
     * @return array $data
     */
    public function register_cm(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id == 1):

                // RECEBIMENTO DO POST
                $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($form)):
                    $data = [
                        'nome' => trim($form['nome']),
                        'email' => trim($form['email']),
                        'senha' => trim($form['senha']),
                        'perfil' => "Gerente de Comunidade",
                        'nome_erro' => '',
                        'email_erro' => '',
                        'senha_erro' => ''
                    ];

                    // VALIDAÇÃO
                    if(in_array("", $form)):
                        if(empty($form['nome'])):
                            $data['nome_erro'] = "Preencha o campo nome";
                        endif;

                        if(empty($form['email'])):
                            $data['email_erro'] = "Preencha o campo email";
                        endif;

                        if(empty($form['senha'])):
                            $data['senha_erro'] = "Preencha o campo senha";   
                        endif;
                    else:
                        if(Validation::validateName($form['nome'])):
                            $data['nome_erro'] = "Insira apenas caracteres alfabéticos";

                        elseif(Validation::validateEmail($form['email'])):
                            $data['email_erro'] = "Insira um email válido";

                        elseif($this->userModel->email_check($form['email'])):
                            $data['email_erro'] = "O email inserido já está cadastrado";

                        elseif(Validation::validatePass($form['senha'])): 
                            $data['senha_erro'] = "A senha deve ter no mínimo 8 caracteres";
                        else:
                            $data['senha'] = md5($form['senha']);
                            
                            // REALIZA O CADASTRO DO USUÁRIO NO BANCO DE DADOS
                            if($this->userModel->register($data)):
                                Alerts::alert('user', 'Gerente de Comunidade cadastrado com sucesso!');
                                header('Location: '.URL.'/users/setings');
                            else:
                                die('Falha ao cadastrar CM');
                            endif;
                        endif;
                    endif;
                    
                else:
                    $data = [
                        'nome' => '',
                        'email' => '',
                        'senha' => '',
                        'perfil' => '',
                        'nome_erro' => '',
                        'email_erro' => '',
                        'senha_erro' => ''
                    ];
                endif;

                // VIEW
                $this->view('users/register_cm', $data);
            else:
                header("Location:".URL);
            endif;
        else:
            header("Location:".URL);
        endif;
    }
    

    /**
     * CONTROLADOR DA PÁGINA DE DADOS CADASTRAIS DO USUÁRIO
     * @return array $data
     */
    public function account(){
        if(isset($_SESSION['user_logged'])):

            // VIEW
            $this->view('navbar');
            $this->view('users/account');
            $this->view('footer');
        else:
            header("Location:".URL);
        endif;
    }
    

    /**
     * CONTROLADOR DA PÁGINA DE EDIÇÃO DOS DADOS CADASTRAIS
     * @return array $data
     */
    public function edit(){
        if(isset($_SESSION['user_logged'])):

            // RECEIMENTO DO POST
            $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(isset($form)):
                $data=[
                    'id' => trim($form['id']),
                    'nome' => trim($form['nome']),
                    'email' => trim($form['email']),
                    'senha' => trim($form['senha']),
                    'perfil' => trim($form['perfil']),
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => '',
                ];

                // VALIDAÇÃO
                if(in_array("", $form)):
                    if(empty($form['nome'])):
                        $data['nome_erro'] = "Preencha o campo nome";
                    endif;

                    if(empty($form['email'])):
                        $data['email_erro'] = "Preencha o campo email";
                    endif;

                    if(empty($form['senha'])):
                        $data['senha_erro'] = "Preencha o campo senha";   
                    endif;
                else:
                    if(Validation::validateName($form['nome'])):
                        $data['nome_erro'] = "Insira apenas caracteres alfabéticos";

                    elseif(Validation::validateEmail($form['email'])):
                        $data['email_erro'] = "Insira um email válido";

                    elseif($this->userModel->email_check_update($form['email'])):
                        $data['email_erro'] = "O email inserido já está cadastrado";

                    elseif(Validation::validatePass($form['senha'])): 
                        $data['senha_erro'] = "A senha deve ter no mínimo 8 caracteres";
                    else:
                        $data['senha'] = md5($form['senha']);
                        
                        // REALIZA O UPDATE DO USUÁRIO NO BANCO DE DADOS E O DESLOGA 
                        if($this->userModel->update($data)):
                            $this->logout();
                            Alerts::alert('user', 'Dados alterados com sucesso! Realize o login novamente');
                            header('Location: '.URL.'/users/login');
                        else:
                            die('Falha ao alterar dados');
                        endif;
                    endif;
                endif;
                
            else:
                $data = [
                    'nome' => '',
                    'email' => '',
                    'senha' => '',
                    'perfil' => '',
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => ''
                ];
            endif;

            // VIEW
            $this->view('users/edit', $data);
        else:
            header("Location:".URL);
        endif;
    }

        
    /**
     * CONTROLADOR DA PÁGINA DE PESQUISA DE USUÁRIOS
     * @return array $data
     */
    public function search(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id < 3):

                // RECEBIMENTO DO POST
                $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($form)):
                    $data = [
                        'search' => trim($form['search']),

                        // BUSCA O USUÁRIO PESQUISADO NO BANCO DE DADOS
                        'users' => $this->userModel->getByName($form['search'])
                    ];

                    // VIEW
                    $this->view('navbar');
                    $this->view('users/search', $data);
                    $this->view('footer');
                endif;
            else:
                header("Location:".URL);
            endif;
        else:
            header("Location:".URL);
        endif;  
    }
}