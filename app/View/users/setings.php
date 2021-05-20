<?php use app\Helpers\Alerts; ?>
<header>
    <div class="img-header-2">
        <div class="container text-center">
            <h1 class="header-font-size">Painel de controle</h1>    
        </div>
    </div>
    <div class="bg-primary padding-header">
        <div class="container">
            <form action="<?=URL?>/users/search" method="POST">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <img src="<?=URL?>/public/img/search.png" alt="search" class="search mt-3 mb-3">
                    </div>
                    <div class="input-width">
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="search" id="search" placeholder="Digite um nome de usuário">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="container text-center">
                    <div class="padding-header"></div>
                    <h2 class="text-light"><span class="underline">USUÁRIOS</span></h2>  
                    <div class="padding-header"></div>
                </div>
                <div class="text-center">
                    <?=Alerts::alert('user')?> 
                </div>
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
            </div>
        </div>
        <div class="padding-header"></div>

        <div class="container text-center">
            <?php if($_SESSION['permission']->id == 1): ?>
                <a href="http://localhost/animetic_mvc/users/register_cm" class="link-info">+ Registar CM</a>
            <?php endif; ?>
        </div>
        <br/><br/><br/>
    </div>
</header>