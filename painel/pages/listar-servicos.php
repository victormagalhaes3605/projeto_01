<?php 
    if(isset($_GET['excluir'])){
        $idExluir = intval($_GET['excluir']);
        Painel::deletar('tb_site.servicos',$idExluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.servicos',$_GET['order'],$_GET['id']);
    }


    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    
    $servicos = Painel::selectAll('tb_site.servicos',($paginaAtual - 1) * $porPagina,$porPagina);
    
?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i>Servicos Cadastrados</h2>
    <div class="wraper-table">
    <table>
        <tr>
            <td>nome</td>
            <td>Data</td>
            <td>Editar</td>
            <td>Deletar</td>
            <td>Subir</td>
            <td>Descer</td>
        </tr>

        <?php
            foreach($servicos as $key => $value){

            
        ?>
        <tr>
            <td><?php echo $value['servicos']; ?></td>
            <td><a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-servico?id=<?php echo $value['id']; ?>">
            <i class="fa fa-pencil"></i></a></td>
            <td><a actionBtn="delete" class="btn-delete"  href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id']; ?>">
            <i class="fa fa-times"></a></td>
            <td><a class="btn-order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=up&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
            <td><a class="btn-order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=down&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-down"></i></a></td>

        </tr>

        <?php } ?>
    </table>
    </div><!--wraper-table-->

     <div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('tb_site.servicos')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
			}

		?> 
	</div><!--paginacao-->
</div><!--box-content-->