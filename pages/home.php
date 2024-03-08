<?php 
   $parametros = \views\mainView::$par;
   
?>

<section class="lista-imoveis">

<div class="container">

    <h2 class="title-busca">Listando <b>100 imóveis</b></h2>
    <?php 
        foreach($parametros['imoveis'] as $key=>$value){
            $imagem = \Msql::conectar()->prepare("SELECT imagem FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $value[id]");
            $imagem->execute();
            $imagem = $imagem->fetch()['imagem'];
    ?>


    <div class="row-imoveis">
        <div class="r1">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagem; ?>" alt="" srcset="">
        </div>
        <div class="r2">
            <p><i class="fa fa-info"></i> Nome do imóvel: <?php echo $value['nome'] ?></p>
            <p><i class="fa fa-info"></i> Área: 1000²:<?php echo $value['area'] ?></p>
            <p><i class="fa fa-info"></i> Preço: <?php echo \Painel::convertMoney($value['preco']); ?></p>
           
        </div>
    </div>

    <?php 
        }
    ?>
</div><!--container-->

</section>