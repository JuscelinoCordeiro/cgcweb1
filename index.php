<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/barra_menu.php'; ?>
<?php require_once 'inc/banner.php'; ?>


<div class="container-fluid" id="total">
    <div class="row-fluid meio">
        <div id="" class="col-xs-9">
            <div id="statis" class="row-fluid">
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-uppercase">os de hj</div>
                        <div class="panel-body text-center">
                            30                                
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-uppercase">os pendente</div>
                        <div class="panel-body text-center">
                            30                                
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-uppercase">resumo 30 dias</div>
                        <div class="panel-body text-center">
                            30                                
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-uppercase">maquinas paradas</div>
                        <div class="panel-body text-center">
                            30                                
                        </div>
                    </div>
                </div>
            </div> <!--fim da div statis-->
            <div id="content-info" class="col-xs-12">
                <table class=" table table-bordered table-hover">
                    <thead>
                    <th>Ord</th>
                    <th>Nr OS</td>
                    <th>Setor Solicitante</th>
                    <th>Id do Equipemento</th>
                    <th>Seviço Solicitado</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>20156</td>
                            <td>Salc</td>
                            <td>DTI-7890</td>
                            <td>Configuração de Token</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>20158</td>
                            <td>Divisão de Alunos</td>
                            <td>DTI-1288</td>
                            <td>Compartilhamento de impressora</td>
                        </tr>
                    </tbody>
                </table> 
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Button with data-target
                </button>
                <div class="collapse" id="collapseExample">
                    <div class="well">
                        Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.
                    </div>
                </div>
            </div> <!--fim da div content-info-->
        </div>
        <div id="svMaisSol" class="col-xs-3 dir text-black">
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>SERVIÇO MAIS SOLICITADO (30 dias)</strong></div>
                <div class="panel-body">
                    <ul>
                        <?php
//                                $lchTpSv = $objQuery->ChamadasPorTipoSv();
                        $i = 0;
//                                foreach ($lchTpSv as $linha) {
                        $i++;
                        ?>
                        <li>
                            <span class="num"><?php echo '1'/* $i */; ?></span>
                            <dl>
                                <dt>Internet</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '2'/* $i */; ?></span>
                            <dl>
                                <dt>Internet</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '3'/* $i */; ?></span>
                            <dl>
                                <dt>Internet</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '4'/* $i */; ?></span>
                            <dl>
                                <dt>Internet</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '5'/* $i */; ?></span>
                            <dl>
                                <dt>Internet</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <!--                                    <li>
                                                                <span class="num"><?php echo '2'/* $i */; ?></span>
                                                                <span class="name"><?php echo "Internet"; // echo $linha->TP_SERVICO;         ?></span>
                                                                <p><?php // echo $i . $linha->QTDE;         ?> 14 Chamados</p>
                                                            </li>-->

                        <?php
//                                    } 
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>CHAMADAS POR SETOR (30 dias)</strong></div>
                <div class="panel-body">
                    <ul>
                        <?php
//                $lch_setor = $objQuery->ChamadasPorSetor();
//                $i = 0;
//                foreach ($lch_setor as $linha) {
//                    $i++;
                        ?>
                        <li>
                            <span class="num"><?php echo '1'/* $i */; ?></span>
                            <dl>
                                <dt>Sargenteação</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '2'/* $i */; ?></span>
                            <dl>
                                <dt>Sargenteação</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '3'/* $i */; ?></span>
                            <dl>
                                <dt>Sargenteação</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '5'/* $i */; ?></span>
                            <dl>
                                <dt>Sargenteação</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <li>
                            <span class="num"><?php echo '5'/* $i */; ?></span>
                            <dl>
                                <dt>Sargenteação</dt>
                                <dd>3 chamados</dd>
                            </dl>
                        </li>
                        <!--                            <li>
                                                        <span class="num"><?php // echo '1'//.$i;           ?></span>
                                                        <span class="name"><?php // echo 'Setor'//.$linha->SETOR;           ?></span>
                                                        <p><?php // echo '23'; //.$linha->QTDE;           ?> Chamados</p>
                                                    </li>-->
                        <?php // } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>//fim da div total
<?php require_once 'inc/footer.php'; ?>