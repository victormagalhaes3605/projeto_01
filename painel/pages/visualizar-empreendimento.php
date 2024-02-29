<?php 
    $id = $par[1];
    $sql = Msql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE id = ?");
    $sql->execute(array($id));
    $infoEmpreend = $sql->fetch();


?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Empreendimento: <?php echo $infoEmpreend['nome'] ?></h2>
    <div class="info-item">
        <div class="row1">
            <div class="card-title"><i class="fa fa-rocket"></i> Imagem :</div>
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $infoEmpreend['imagem']; ?>">
        </div><!--row2-->
        <div class="row2">
            <div class="card-title"><i class="fa fa-rocket"></i> Informações do empreendimento:</div>
            <p><i class="fa fa-pencil"></i> Nome do empreendimento: <?php echo $infoEmpreend['nome'] ?></p>
            <p><i class="fa fa-pencil"></i> $tipo: <?php echo ucfirst($infoEmpreend['tipo']) ?></p>
        </div><!--row2-->

        <div class="clear"></div>

    </div><!--info-intem-->
    
</div><!--box-content-->