<?php 
    if(isset($_GET['excluir'])){
        $idExluir = intval($_GET['excluir']);
        $selectImagem = Msql::conectar()->prepare("SELECT capa FROM `tb_site.noticias` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));

        $imagem = $selectImagem->fetch()['capa'];
        Painel::deleteFile($imagem);
        Painel::deletar('tb_site.noticias',$idExluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticias');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.noticias',$_GET['order'],$_GET['id']);
    }


    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    
    $noticias = Painel::selectAll('tb_site.noticias',($paginaAtual - 1) * $porPagina,$porPagina);
    
?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i>Produtos Cadastrados</h2>

    <div class="busca">
        <h4><i class ="fa fa-search"></i> Realizar uma busca</h4>
        <form action="" method="post">
            <input type="text" name="busca" placeholder="Procure pelo nome do produto">
            <input type="submit" value="Buscar!" name="acao">
        </form>
    </div><!--busca-->

    <div class="boxes">

    <?php
    if(isset($_POST['acao'])){
        $busca = $_POST['busca'];
        @$query = " WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' OR cpf_cnpj LIKE '%$busca%'";
    }
    
        @$clientes = MSql::conectar()->prepare("SELECT * FROM `tb_admin.clientes` $query");
        $clientes->execute();
        $clientes = $clientes->fetchAll();
        if(isset($_POST['acao'])){
            echo '<div style="width:100%" class="busca-result"> <p>foram encontrados <b>'.count($clientes).'</b> resultados(s)</p></div>';
        }
        foreach($clientes as $value){

        
        ?>
        <div class="box-single-wraper">
            <div class="box-single">
                <div class="topo-box">
                    <?php 
                        if($value['imagem'] == ''){
                            ?>
                            
                            <h2><i class="fa fa-user"></i></h2>
                        <?php } else { ?>
                            <img src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['imagem'];?>">
                        <?php } ?>

                </div><!--topo-box-->
                <div class="body-box">
                    <p><b><i class="fa fa-address-card"></i>Nome do cliente : </b><?php echo $value['nome']; ?></p>
                    <p><b><i class="fa fa-address-card"></i>Email : </b><?php echo $value['email']; ?></p>
                    <p><b><i class="fa fa-address-card"></i>tipo : </b><?php echo ucfirst($value['tipo']); ?></p>
                    <p><b><i class="fa fa-address-card"></i><?php
                        if($value['tipo'] == 'fisico')
                        echo 'CPF :';
                    else
                        echo 'CNPJ :';
                    ?> : </b> <?php echo $value['cpf_cnpj']; ?></p>
                    <div class="group-btn">
                        <a class="btn-delete" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-times"></i></a>

                        <a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-cliente?id=<?php echo $value['id']; ?>">
                        <i class="fa fa-pencil"></i></a>


                    </div>
                    </div>
            </div><!--box-single-->

        </div><!--box-single-wraper-->
        <?php } ?>

    <div class="clear"></div>

    </div><!--boxes-->
    

</div><!--box-content-->