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
                <?=Alerts::alert('user')?> 
                <?php if(!empty($data['users'])): ?>
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Perfil</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach($data['users'] as $user): ?>
                            <tr class="table">
                                <td><?=$user->nome?></td>
                                <td><?=$user->email?></td>
                                <td><?=$user->perfil?></td>
                                <td>
                                    <form method="POST" action="<?=URL?>/users/delete">
                                        <input name="perfil" type="hidden" value="<?=$user->perfil?>">  
                                        <input name="id" type="hidden" value="<?=$user->id?>">
                                        <button type="submit" class="btn btn-link text-danger">Excluir</button>
                                    </form>
                                    <br/>
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
        <div class="padding-header"></div>
        <br/><br/><br/>
    </div>
</header>