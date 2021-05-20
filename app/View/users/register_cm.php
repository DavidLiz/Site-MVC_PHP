<div class="img-register">
    <a href="<?=URL?>/users/setings" class="ml-3">< RETORNAR</a>
    <div class="col-xl-4 col-md-5 mx-auto p-5 fadeInDown">
        <div class="card">
            <div class="card-body ">
                <h2 class="text-center">REGISTRAR CM</h2>                
                <hr/>
                <form id ="form" name="login" method="POST" action="<?=URL?>/users/register_cm">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control <?=$data['nome_erro'] ? 'is-invalid' : ''?>" value="<?=$data['nome']?>"> 
                        <div class="invalid-feedback"><?=$data['nome_erro']?></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control <?=$data['email_erro'] ? 'is-invalid' : ''?>" value="<?=$data['email']?>"> 
                        <div class="invalid-feedback"><?=$data['email_erro']?></div>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" class="form-control <?=$data['senha_erro'] ? 'is-invalid' : ''?>" value="<?=$data['senha']?>"> 
                        <div class="invalid-feedback"><?=$data['senha_erro']?></div>
                    </div>
                    <br/>
                    <div class="btn-group d-flex">
                        <input type="submit" value="REGISTRAR" class="btn btn-info">
                    </div>
                    <br/><hr/>
                </form>
            </div>
        </div>
    </div>
</div>