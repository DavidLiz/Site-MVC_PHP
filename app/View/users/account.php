<header>
    <div class="img-header-2">
        <div class="container text-center">
            <h1 class="header-font-size">Minha Conta</h1>    
        </div>
    </div>  
</header>
<section class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <div class="container text-center">
                    <h2 id="header-subtitle"><span class="underline">Dados Cadastrados</span></h2><br/><br/><br/><br/>
                </div>
                <div class="pt-5">
                    <div id="left"><img src="../img/pngegg.png" alt="profile" class="profile" style="border:none; width:350px; height: 350px"><br/></div>

                    <div id="right">
                        <h4 id="header-subtitle"><strong>Nome: </strong> <?= $_SESSION['user_logged']->nome?></h4><br/><br/><br/>
                        <h4 id="header-subtitle"><strong>Email: </strong> <?= $_SESSION['user_logged']->email ?></h4><br/><br/><br/>
                        <h4 id="header-subtitle"><strong>Perfil: </strong> <?= $_SESSION['user_logged']->perfil?></h4><br/><br/><br/>
                        <h4><strong><a href="<?=URL?>/users/edit" id="header-subtitle" class="text-info">Alterar Dados</a></strong><br></br></h4> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>