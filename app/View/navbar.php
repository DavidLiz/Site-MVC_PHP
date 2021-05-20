<?php
    $url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary <?php if($url_atual == URL."/"): ?>fixed-top<?php endif; ?>">
        <div class="container-fluid">
            <div class="">
                <a class="navbar-brand" href="<?=URL?>">Animetic</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <?php if($url_atual == URL."/"): ?>
                <div class="collapse navbar-collapse position-absolute top-50 start-50 translate-middle" id="navbarColor01">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=URL?>/pages/projects">Projetos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#community">Comunidade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contato</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="d-flex">
                <?php if(!isset($_SESSION['user_logged']->id)): ?>
                    <a class="btn btn-info my-sm-0" href="<?=URL?>/users/login">Acessar</a>
                <?php else: ?>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$_SESSION['user_logged']->email?></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?=URL?>/users/account">Minha Conta</a>
                            <?php if($_SESSION['permission']->id<3): ?>
                                <a class="dropdown-item" href="<?=URL?>/users/setings">Usuários</a>
                                <a class="dropdown-item" href="<?=URL?>/projects/setings">Projetos</a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=URL?>/users/logout">Sair</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
