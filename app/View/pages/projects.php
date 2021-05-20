<header class="img-header">
    <div class="container text-center">
        <div class="padding-header">
            <h2 class="header-font-size">Nosso Portifólio</h2>    
            <h4 class="text-light">"BUSCAMOS TRAZER, COM NOSSOS JOGOS, UMA EXPERIÊNCIA ÚNICA E MARCANTE AO JOGADOR"</h4><br></br>
        </div>
        <a href="#projects"><img id="scroll" src="../img/mouse-down.gif" alt="rolagem"></a>
    </div>
</header>

<?php foreach($data['projects'] as $project):?>
    <section class="container-project" id="projects" style="background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(37, 37, 37, 0.6)), url(../<?=$project->banner?>); background-attachment: fixed; background-repeat: no-repeat;  background-size: 100%; ">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <h2 id="header-subtitle"><span class="underline"><?=$project->titulo?></span></h2>
                    <br/><br/><br/>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div id="left"><img src="../<?=$project->banner?>" alt="banner"></div>
            <div class="container text-center" id="right">
                <p id="header-subtitle"><span><?=$project->descricao?></span></p>
                <br/>
                <h5 id="header-subtitle">Disponível para:</h5>
                <div class="d-flex justify-content-center" style="padding-top: 20px;">
                    <img src="<?=URL?>/img/steam.png" alt="steam" class="game">
                    <img src="<?=URL?>/img/apple.png" alt="steam" class="game">
                    <img src="<?=URL?>/img/android.png" alt="steam" class="game">
                </div>
                <br/>
                <br/><br/>
                <button class="btn btn-outline-light btn-lg">Saiba Mais</button>
            </div>
        </div>
    </section>
<?php endforeach; ?>