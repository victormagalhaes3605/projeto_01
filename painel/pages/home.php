<?php
    $usuariosOnline = Painel::listarUsuariosOnline();
    $pegarVisitasTotais = Msql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
    $pegarVisitasTotais->execute();

    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

    $pegarVisitasHoje = Msql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
    $pegarVisitasHoje->execute(array(date('Y-m-d')));

    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>

<div class="box-content  w100">
    <h2><i class="fa fa-home"></i> Painel de Controle </h2>

    <div class="box-metricas">
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Usuarios Online</h2>
                <p><?php echo count($usuariosOnline); ?></p>
            </div><!--box-metrica-Wraper-->
        </div><!--box-metrica-single-->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Total de visitas</h2>
                <p><?php echo $pegarVisitasTotais; ?></p>
            </div><!--box-metrica-Wraper-->
        </div><!--box-metrica-single-->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Visitas hoje</h2>
                <p><?php echo $pegarVisitasHoje; ?></p>
            </div><!--box-metrica-Wraper-->
        </div><!--box-metrica-single-->
        <div class="clear"></div>
    </div><!--box-metricas-->


    </div><!--box-content-->

<div class="box-content  w100">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuarios online no site </h2>

<div class="table-responsive">
    <div class="row">
        <div class="col">
            <span>nome</span>
        </div><!--col-->
        <div class="col">
            <span>Cargo</span>
        </div><!--col-->
        <div class="clear"></div>
    </div><!--row-->

    <?php 
    $usuariosPainel = Msql::conectar()->prepare("SELECT * FROM `tb_adm.usuarios`");
    $usuariosPainel->execute();
    $usuariosPainel = $usuariosPainel->fetchAll();
    foreach($usuariosOnline as $key => $value){
    ?>

    <div class="row">
        <div class="col">
            <span><?php echo $value['ip']; ?></span>
        </div><!--col-->
        <div class="col">
            <span><?php echo date('d/m/Y H:i:m',strtotime($value['ultima_acao'])); ?></span>
        </div><!--col-->
        <div class="clear"></div>
    </div><!--row-->
    <?php } ?>
</div><!--teble-responsive-->
</div><!--box-content-->

<div class="box-content  w100">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuarios do painel </h2>

<div class="table-responsive">
    <div class="row">
        <div class="col">
            <span>IP</span>
        </div><!--col-->
        <div class="col">
            <span>ultima ação</span>
        </div><!--col-->
        <div class="clear"></div>
    </div><!--row-->

    <?php 
    foreach($usuariosPainel as $key => $value){
    ?>

    <div class="row">
        <div class="col">
            <span><?php echo $value['user']; ?></span>
        </div><!--col-->
        <div class="col">
            
            <span><?php echo pegaCargo($value['cargo']); ?></span>
        </div><!--col-->
        <div class="clear"></div>
    </div><!--row-->
    <?php } ?>
</div><!--teble-responsive-->
</div><!--box-content-->