<?php 
    if(isset($_GET['excluir'])){
        $idExluir = intval($_GET['excluir']);
        Painel::deletar('tb_site.categorias',$idExluir);
        $noticias = Msql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE categoria_id = ?");
        $noticias->execute(array($idExluir));
        $noticias = $noticias->fetchAll();
        foreach($noticias as $kkey => $value){
            $imgDelete = $value['capa'];
            Painel::deleteFile($imDelete);
        }
        $noticias = Msql::conectar()->prepare("DELETE FROM `tb_site.noticias` WHERE categoria_id = ?");
        $noticias->execute(array($idExluir));
        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-categorias');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.categorias',$_GET['order'],$_GET['id']);
    }


    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    
    $categorias = Painel::selectAll('tb_site.categorias',($paginaAtual - 1) * $porPagina,$porPagina);
    
?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i>Categorias Cadastradas</h2>
    <div class="wraper-table">
    <table>
        <tr>
            <td>nome</td>
            <td>Editar</td>
            <td>Deletar</td>
            <td>Subir</td>
            <td>Descer</td>
        </tr>

        <?php
            foreach($categorias as $key => $value){

            
        ?>
        <tr>
            <td><?php echo $value['nome']; ?></td>
            <td><a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php echo $value['id']; ?>">
            <i class="fa fa-pencil"></i></a></td>
            <td><a actionBtn="delete" class="btn-delete"  href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?excluir=<?php echo $value['id']; ?>">
            <i class="fa fa-times"></a></td>
            <td><a class="btn-order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=up&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
            <td><a class="btn-order" href="<?php echo INCLUDE_PATH_PAINEL ?>Gerenciar-categorias?order=down&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-down"></i></a></td>

        </tr>

        <?php } ?>
    </table>
    </div><!--wraper-table-->

     <div class="paginacao">
		
	</div><!--paginacao-->
</div><!--box-content-->