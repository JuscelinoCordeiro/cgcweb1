
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SGI</title>
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <script type="text/javascript" src="js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="js/bootstrap-dropdown.js"></script>
    </head>
    <body>
        <div id="total" class="row-fluid">
            <div id="topo" class="span12 topo">cabecalho</div>
        </div>
        <div class="row-fluid">
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">SGI - NOVO</a>
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Início</a></li>
                            <li><a href="#">Link 1</a></li>
                            <li><a href="#">Link 2</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Usuários <b class="caret"></b></a>
                                <ul class="dropdown-menu"  role="menu" aria-labelledby="dropdownMenu">
                                    <li><a href="#"><i class="icon-user"></i> Listar Usuários</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"> <i class="icon-list-alt"></i> Listar Motoristas</a></li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="#">Mais opções</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Link 1</a></li>
                                            <li><a href="#">Link 2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid meio">
            <div id="" class="col-xs-9 esq">
                <p class="text-success">conteudo</p>
            </div>
            <div id="" class="col-xs-3 dir">conteudo</div>
        </div>
        <div class="row-fluid">
            <div id="rodape" class="col-xs-12 rodape">rodape
                <a href="geraPdf.php" class="btn btn-danger">Cancelar <i class="icon-file icon-white"></i></a>
                <a href="geraPdf.php" class="btn btn-default">Gerar pdf <i class="icon-file icon-white"></i></a>
                <a href="geraPdf.php" class="btn btn-primary">Gerar pdf <i class="icon-file icon-white"></i></a>
                <a href="geraPdf.php" class="btn btn-warning">Gerar pdf <i class="icon-file icon-white"></i></a>
                <a href="geraPdf.php" class="btn btn-success">Login <i class="icon-file icon-white"></i></a>
                <a href="geraPdf.php" class="btn btn-info">Gerar pdf <span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>
                <a href="geraPdf.php" class="btn btn-inverse">Gerar pdf <i class="icon-file icon-white"></i></a>
                <button class="btn btn-link">teste</button>
            </div>            
        </div>
    </body>
</html>
