<?php
use app\Helpers\Alerts;
use app\Libraries\Controller;

class Projects extends Controller{

    public function __construct()
    {
        if(!Alerts::user_logged()):
            header('location: '.URL."/users/login");
        endif;

        $this->projectModel = $this->model('Project');

        // RESTRIÇÃO DE ACESSO
        if($_SESSION['permission']->id > 2):
            header('Location:'.URL);
        endif;
    }

    
    /**
     * CONTROLADOR DA PÁGINA DE REGISTROS DE PROJETOS
     * @return array $data
     */
    public function register(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id<3):

                //RECEBIMENTO DO POST
                $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($form)):

                    // RENOMEIA E MOVE A IMAGEM
                    $extensao = strtolower(substr($_FILES['banner']['name'], -4));
                    $rename = md5(time()).$extensao;
                    $diretorio = "../public/assets/";
                    move_uploaded_file($_FILES['banner']['tmp_name'], $diretorio.$rename);
                    $newName = 'assets/'.$rename;   
                    $data=[
                        'titulo' => trim($form['titulo']),
                        'descricao' => trim($form['descricao']),
                        'valor' => trim($form['valor']),
                        'banner' => $newName,
                        'criado_por' => trim($form['criado_por']),
                        'titulo_erro' => '',
                        'descricao_erro' => '',
                        'valor_erro' => '',
                        'banner_erro' => ''
                    ];

                    // VALIDAÇÃO
                    if(in_array("", $form)):
                        if(empty($form['titulo'])):
                            $data['titulo_erro'] = "Preencha o campo titulo";
                        endif;

                        if(empty($form['descricao'])):
                            $data['descricao_erro'] = "Preencha o campo descricao";
                        endif;

                        if(empty($form['valor'])):
                            $data['valor_erro'] = "Preencha o campo valor";
                        endif;

                        if(empty($form['banner'])):
                            $data['banner_erro'] = "Adicione um arquivo";   
                        endif;
                        
                    else:

                        // REALIZA O REGISTRO DO PROJETO NO BANCO DE DADOS
                        if($this->projectModel->register($data)):
                            Alerts::alert('project', 'Projeto cadastrado com sucesso!');
                            header('Location: '.URL.'/projects/setings');
                        else:
                            die('Falha ao cadastrar projeto');
                        endif;
                    endif;

                else:
                    $data = [
                        'titulo' => '',
                        'descricao' => '',
                        'valor' => '',
                        'banner' => '',
                        'criado_por' => '',
                        'titulo_erro' => '',
                        'descricao_erro' => '',
                        'valor_erro' => '',
                        'banner_erro' => ''
                    ];
                endif;

                // VIEW
                $this->view('navbar');
                $this->view('projects/register', $data);
                $this->view('footer');
            else:
                header("Location:".URL);
            endif;     
        else:
            header("Location:".URL);
        endif;
    }

    
    /**
     * CONTROLADOR DA PÁGINA DE LISTAGEM DE PROJETOS
     * @return array $data
     */
    public function setings(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id<3):

                // LISTA TODOS OS PROJETOS
                $data = [
                    'projects' => $this->projectModel->get()
                ];

                // VIEW
                $this->view('navbar');
                $this->view('projects/setings', $data);
                $this->view('footer');
            else:
                header("Location:".URL);
            endif;
        else:
            header("Location:".URL);
        endif;
    }

    
    /**
     * CONTROLADOR DA PÁGINA DE EDIÇÃO DE PROJETOS
     * @return array $data
     */
    public function edit(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id<3):

                // RECEBIMENTO DO POST
                $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($form)):
                    $data=[
                        'id' => trim($form['id']),
                        'titulo' => trim($form['titulo']),
                        'descricao' => trim($form['descricao']),
                        'valor' => trim($form['valor']),
                        'banner' => trim($form['banner']),
                        'criado_por' => trim($form['criado_por']),
                        'titulo_erro' => '',
                        'descricao_erro' => '',
                        'valor_erro' => '',
                        'banner_erro' => ''
                    ];
                else:
                    $data = [
                        'id' => '',
                        'titulo' => '',
                        'descricao' => '',
                        'valor' => '',
                        'banner' => '',
                        'criado_por' => '',
                        'titulo_erro' => '',
                        'descricao_erro' => '',
                        'valor_erro' => '',
                        'banner_erro' => ''
                    ];
                    header("Location:".URL.'/projects/setings');
                endif;

                // VIEW
                $this->view('navbar');
                $this->view('projects/edit', $data);
                $this->view('footer');
            else:
                header("Location:".URL);
            endif;
        else:
            header("Location:".URL);
        endif;
    }

    
    /**
     * FUNÇÃO DE UPDATE DE PROJETOS
     */
    public function update(){
        if(isset($_SESSION['user_logged'])):

            // RECEBIMENTO DO POST
            $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(isset($form)):

                // RENOMEIA E MOVE A IMAGEM
                $extensao = strtolower(substr($_FILES['banner']['name'], -4));
                $rename = md5(time()).$extensao;
                $diretorio = "../public/assets/";
                move_uploaded_file($_FILES['banner']['tmp_name'], $diretorio.$rename);
                $newName = 'assets/'.$rename;   
                $data=[
                    'id' => trim($form['id']),
                    'titulo' => trim($form['titulo']),
                    'descricao' => trim($form['descricao']),
                    'valor' => trim($form['valor']),
                    'banner' => $newName,
                    'criado_por' => trim($form['criado_por']),
                    'titulo_erro' => '',
                    'descricao_erro' => '',
                    'valor_erro' => '',
                    'banner_erro' => ''
                ];

                // VALIDAÇÃO
                if(in_array("", $form)):
                    if(empty($form['titulo'])):
                        $data['titulo_erro'] = "Preencha o campo titulo";
                    endif;

                    if(empty($form['descricao'])):
                        $data['descricao_erro'] = "Preencha o campo descricao";
                    endif;

                    if(empty($form['valor'])):
                        $data['valor_erro'] = "Preencha o campo valor";
                    endif;

                    if(empty($form['banner'])):
                        $data['banner_erro'] = "Adicione um arquivo";   
                    endif;
                else:   

                    // RESTRIÇÃO DE ACESSO (APENAS O USUÁRIO QUE CRIOU PODE EDITAR)
                    if($_SESSION['user_logged']->id == $data['criado_por'] || $_SESSION['permission']->id == 1):

                        // REALIZA O UPDATE DO PROJETO NO BANCO DE DADOS
                        if($this->projectModel->update($data)):
                            unlink($form['old_banner']);
                            Alerts::alert('project', 'Projeto atualizado com sucesso!');
                            header('Location: '.URL.'/projects/setings');
                        else:
                            die('Falha ao atualizar projeto');
                        endif;
                    else:
                        Alerts::alert('project', 'Você não possui permissão para editar esse projeto!', 'alert alert-danger');
                        header('Location: '.URL.'/projects/setings');
                    endif;
                endif;

            else:
                $data = [
                    'id' => '',
                    'titulo' => '',
                    'descricao' => '',
                    'valor' => '',
                    'banner' => '',
                    'criado_por' => '',
                    'titulo_erro' => '',
                    'descricao_erro' => '', 
                    'valor_erro' => '',
                    'banner_erro' => ''
                ];
            endif;

            // VIEW
            $this->view('navbar');
            $this->view('projects/edit', $data);
            $this->view('footer');
        else:
            header("Location:".URL);
        endif;
    }

    
    /**
     * FUNÇÃO DE DELETE DE PROJETOS
     */
    public function delete(){

        // RESTRIÇÃO DE ACESSO
        if(isset($_SESSION['user_logged'])):
            if($_SESSION['permission']->id<3):

                // RECEBIMENTO DO POST
                $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($form)):
                    $data = [
                        "criado_por" => trim($form['criado_por']),
                        "id" => trim($form['id']),
                        "banner" => trim($form['banner']) 
                    ];
                    
                    // RESTRIÇÃO DE ACESSO (APENAS O USUÁRIO QUE CRIOU PODE DELETAR)
                    if($_SESSION['user_logged']->id == $data['criado_por'] || $_SESSION['permission']->id == 1):

                        // DELETA O PROJETO DO BANCO DE DADOS
                        if($this->projectModel->delete($data)):
                            Alerts::alert('project', 'Projeto excluído com sucesso!');
                            header('Location: '.URL.'/projects/setings');
                        else:
                            die('Falha ao excluir projeto');
                        endif;
                    else:
                        Alerts::alert('project', 'Você não possui permissão para excluir esse projeto!', 'alert alert-danger');
                        header('Location: '.URL.'/projects/setings');
                    endif;
                endif;

                // VIEW
                $this->view('navbar');
                $this->view('projects/delete', $data);
                $this->view('footer');
            else:
                header("Location:".URL);
            endif;
        else:
            header("Location:".URL);
        endif;
    }

    
    /**
     * CONTROLADOR DA PÁGINA DE PESQUISA DE PROJETOS
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

                        // BUSCA O PROJETO PESQUISADO NO BANCO DE DADOS
                        'projects' => $this->projectModel->getByName($form['search'])
                    ];

                    // VIEW
                    $this->view('navbar');
                    $this->view('projects/search', $data);
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
