<div class="bg-primary">
    <div class="col-xl-6 col-md-5 mx-auto p-4">
        <div class="card">
            <div class="card-body ">
                <h2 class="text-center">EDITAR PROJETO</h2>      
                <hr/>
                <form id ="form" name="register" method="POST" action="<?=URL?>/projects/update" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?=$_POST['id']?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="criado_por" value="<?=$_POST['criado_por']?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="old_banner" value="<?=$_POST['banner']?>">
                    </div>
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" name="titulo" value="<?=$_POST['titulo']?>" class="form-control <?=$data['titulo_erro'] ? 'is-invalid' : ''?>"> 
                        <div class="invalid-feedback"><?=$data['titulo_erro']?></div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" class="form-control <?=$data['descricao_erro'] ? 'is-invalid' : ''?>" id="exampleFormControlTextarea1" rows="4"><?=$_POST['descricao']?></textarea>
                        <div class="invalid-feedback"><?=$data['descricao_erro']?></div>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                            <input type="number" class="form-control <?=$data['valor_erro'] ? 'is-invalid' : ''?>" aria-label="Amount (to the nearest dollar)" name="valor" value="<?=$_POST['valor']?>">
                            <div class="invalid-feedback"><?=$data['valor_erro']?></div>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label for="banner">Banner</label>
                        <input type="file" name="banner" class="form-control <?=$data['valor_erro'] ? 'is-invalid' : ''?>">
                        <div class="invalid-feedback"><?=$data['banner_erro']?></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.href='http://localhost/animetic_mvc/projects/setings';">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>