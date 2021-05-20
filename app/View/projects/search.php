<?php use app\Helpers\Alerts; ?>
<header>
    <div class="bg-primary padding-header" style="min-height: 90vh;">
        <div class="container">
            <a href="<?=URL?>/projects/setings"><h5 class="text-light">< Retornar</h5></a>
            <div class="row">
                <div class="container text-center">
                    <div class="padding-header"></div>
                    <h2 class="text-light"><span>Resultados para <?=$data['search'] ?> ...</span></h2>  
                    <div class="padding-header"></div>
                </div>
                <?=Alerts::alert('project')?> 
                <?php if(!empty($data['projects'])): ?>
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
                <?php else: ?>
                    <div class="d-flex justify-content-center">
                        <h4 class="text-danger"><span>Nenhum resultado encontrado</span></h4>  
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>