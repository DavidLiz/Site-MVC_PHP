<?php use app\Helpers\Alerts; ?>

<div class="img-login">
    <a href="<?=URL?>" class="ml-3">< PÁGINA PRINCIPAL</a>
    <div class="col-xl-4 col-md-6 mx-auto p-5 fadeInDown">
        <div class="card">
            <div class="card-body ">
                <h2 class="text-center">LOGIN</h2>  
                <?=Alerts::alert('user')?>          
                <hr/>
                <br/>
                <form name ="login" method="POST" action="<?=URL?>/users/login">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control <?=$data['email_erro'] ? 'is-invalid' : ''?>"> 
                        <div class="invalid-feedback"><?=$data['email_erro']?></div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" class="form-control <?=$data['senha_erro'] ? 'is-invalid' : ''?>"> 
                        <div class="invalid-feedback"><?=$data['senha_erro']?></div>
                    </div>
                    <br/><br/>
                    <div class="btn-group d-flex">
                        <input type="submit" value="LOGIN" class="btn btn-info">
                    </div>
                    <br/><hr/>
                    <a href="<?=URL?>/users/register">
                        <br/>
                        <h6 class="text-center">Não possui uma conta?</h6> 
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>