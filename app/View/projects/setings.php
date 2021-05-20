<?php use app\Helpers\Alerts; ?>
<header>
    <div class="img-header-2">
        <div class="container text-center">
            <h1 class="header-font-size">Painel de controle</h1> 
        </div>
    </div>
    <div class="bg-primary padding-header">
        <div class="container">
            <form action="<?=URL?>/projects/search" method="POST">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <img src="<?=URL?>/public/img/search.png" alt="search" class="search mt-3 mb-3">
                    </div>
                    <div class="input-width">
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="search" id="search" placeholder="Digite um título de projeto">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="container text-center">
                    <div class="padding-header"></div>
                    <h2 class="text-light"><span class="underline">Projetos</span></h2>  
                    <div class="padding-header"></div>
                </div>
                <div class="text-center">
                    <?=Alerts::alert('project')?> 
                </div>  
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach($data['projects'] as $project): ?>
                        <tr class="table">
                            <td><?=$project->titulo?></td>
                            <td><?=$project->descricao?></td>
                            <td>R$<?=$project->valor?>,00</td>
                            <td>
                                <form method="POST" action="<?=URL?>/projects/delete">
                                    <input type="hidden" name="criado_por" value="<?=$project->criado_por?>">
                                    <input name="id" type="hidden" value="<?=$project->id?>">
                                    <input name="banner" type="hidden" value="<?=$project->banner?>">
                                    <button type="submit" class="btn btn-link text-danger">Excluir</button>
                                </form>
                                <br/>
                                <form method="POST" action="<?=URL?>/projects/edit">
                                    <input name="id" type="hidden" value="<?=$project->id?>">
                                    <input name="titulo" type="hidden" value="<?=$project->titulo?>">
                                    <input name="descricao" type="hidden" value="<?=$project->descricao?>">
                                    <input name="valor" type="hidden" value="<?=$project->valor?>">
                                    <input name="banner" type="hidden" value="<?=$project->banner?>">
                                    <input type="hidden" name="criado_por" value="<?=$project->criado_por?>">
                                    <button type="submit" class="btn btn-link text-info">Editar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="padding-header"></div>

        <div class="container text-center">
            <a href="http://localhost/animetic_mvc/projects/register" class="link-info">+ Novo Projeto</a>
        </div>
        <br/><br/><br/>
    </div>
</header>



