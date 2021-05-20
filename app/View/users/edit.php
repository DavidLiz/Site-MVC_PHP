<?php use app\Helpers\Alerts; ?>
<div class="img-login">
    <a href="<?=URL?>/users/account" class="ml-3">< MINHA CONTA</a>
    <div class="col-xl-4 col-md-6 mx-auto p-5 fadeInDown">
        <div class="card">
            <div class="card-body ">
                <h2 class="text-center">Alterar Dados</h2>  
                <?=Alerts::alert('user')?>          
                <hr/>
                <form name ="login" method="POST" action="<?=URL?>/users/edit">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?=$_SESSION['user_logged']->id?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="perfil" value="<?=$_SESSION['user_logged']->perfil?>">
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control <?=$data['nome_erro'] ? 'is-invalid' : ''?>" value="<?=$_SESSION['user_logged']->nome?>"> 
                        <div class="invalid-feedback"><?=$data['nome_erro']?></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control <?=$data['email_erro'] ? 'is-invalid' : ''?>" value="<?=$_SESSION['user_logged']->email?>"> 
                        <div class="invalid-feedback"><?=$data['email_erro']?></div>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" class="form-control <?=$data['senha_erro'] ? 'is-invalid' : ''?>"> 
                        <div class="invalid-feedback"><?=$data['senha_erro']?></div>
                    </div>
                    <br/><br/>
                    <div class="btn-group d-flex">
                        <input type="submit" value="ALTERAR DADOS" class="btn btn-info">
                    </div>
                    <br/><hr/>
                </form>
            </div>
        </div>
    </div>
</div>
