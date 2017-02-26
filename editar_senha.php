<?php
    require_once 'inc/header.php';
    require_once 'inc/barra_menu.php';
    require_once 'inc/banner.php';
?>
<div class="row-fluid">
    <div class="col-xs-12 meio">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
            <fieldset id="fieldset-login">
                <form name="form-login" action="" method="post">
                    <legend class="text-black hr3">Editar Senha</legend>
                    <div class="form-group">
                        <label class="control-label">Senha atual</label>
                        <input class="form-control" type="text" name="senha_atual" placeholder="Digite sua senha atual" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nova senha</label>
                        <input class="form-control" type="password" name="nova_senha1" placeholder="Digite sua nova senha" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nova senha</label>
                        <input class="form-control" type="password" name="nova_senha2" placeholder="Redigite sua nova senha" required />
                    </div>
                    <input type="hidden" name="cod_user" value="<?php echo $dUsuario->CD_USER; ?>"/>
                    <input type="hidden" name="acao" value="editar_senha"/>
                    <input type="submit" value="Confirmar" class="btn btn-danger pull-right" onclick="return validar()"/>
                </form>

            </fieldset>
        </div><!--fim da div formlogin-->
        <div class="col-xs-2"></div>
    </div><!--fim da div meio-->
</div>
<?php require_once 'inc/footer.php'; ?>