<?php
    session_start();
    require_once './classes/DB.class.php';
    require_once 'classes/Login.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SGI - Login</title>
        <link href="../css/estilo.css" type="text/css" rel="stylesheet"/>
        <link href="../css/bootstrap.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
    </head>
    <body>
        <div class="row-fluid">
            <div class="col-xs-12 topo">
                cabecalho
            </div>
        </div>
        <div class="row-fluid">
            <div class="col-xs-12 meio">
                <!--<div id="formLogin">-->
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <fieldset id="fieldset-login">
                        <form name="form-login" action="" method="post">
                            <legend class="text-black hr3">SGI - Login</legend>
                            <div class="form-group">
                                <label class="control-label">Identidade</label>
                                <input class="form-control" type="text" name="idt" placeholder="Digite sua identidade" required />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Senha</label>
                                <input class="form-control" type="password" name="senha" placeholder="Digite sua senha" required />
                            </div>
                            <input type="hidden" name="acao" value="logar"/>
                            <input type="submit" value="Entrar" class="btn btn-success pull-right" onclick="return validar()"/>
                        </form>

                    </fieldset>
                    <?php
                        if (isset($_POST['acao']) && ($_POST['acao'] == 'logar')) {
                            $idt = (int) strip_tags(filter_input(INPUT_POST, 'idt'));
                            $senha = strip_tags(filter_input(INPUT_POST, 'senha'));

                            $log = new Login();
                            if ($idt == '' || $senha == '') {
                                echo '<div class="alert alert-danger" role="alert">
                                                        <p class="text-center"><strong>ERRO!</strong> Usuário e/ou senha inválidos.</p>
                                                    </div>';
                            } else {
                                if ($log->logar($idt, $senha)) {
                                    //redireciona via php - semelhante ao location.href
                                    header("Location: admin.php");
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">
                                                        <p class="text-center"><strong>ERRO!</strong> Usuário e/ou senha inválidos.</p>
                                                    </div>';
                                }
                            }
                        }
                    ?>
                </div><!--fim da div formlogin-->
            </div>
            <div class="col-xs-4"></div>

        </div><!--fim da div meio-->
        <div class="row-fluid">
            <div class="col-xs-12">
                <hr class="hr2">
            </div>
        </div>

        <div class="row-fluid">
            <div class="col-xs-12 well well-lg">
                <center><span class="rodape-login">Copyright &COPY; Todos os direitos reservados</span></center>
            </div>
        </div><!--fim da div rodape-->
    </body>
</html>
