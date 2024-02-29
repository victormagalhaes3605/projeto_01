<?php 


  
?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Empreendimentos</h2>

    <div class="busca">
        <h4 style="color: black;"><i class ="fa fa-search"></i> Realizar uma busca</h4>
        <form action="" method="post">
            <input type="text" name="busca" placeholder="Procure por: nome, email, cpf ou cnpj">
            <input type="submit" value="Buscar!" name="acao">
        </form>
    </div><!--busca-->
        <?php 
           		if(isset($_GET['deletar'])){
                    //queremos deletar algum produto.
                    $id = (int)$_GET['deletar'];
                    $imagens = Msql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE id = $id");
                    $imagens->execute();
                    $imagens = $imagens->fetch();
                        @unlink(BASE_DIR_PAINEL.'/uploads/'.$imagens['imagem']);
                    
                    Msql::conectar()->exec("DELETE FROM `tb_admin.empreendimentos` WHERE id = $id");
                    Painel::alert('sucesso',"O produto foi deletado do empreendimentos com sucesso!");
                }

       
        ?>

    <div class="boxes">

    <?php
			$query = "";
			if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar!'){
				$nome = $_POST['busca'];
				$query = "WHERE (nome LIKE '%$nome%')";
			}
			if($query == ''){
				$query2 = "";
			}else{
				$query2 = "";
			}
			$sql = Msql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` $query ORDER BY order_id ASC");

			$sql->execute();
			$produtos = $sql->fetchAll();
			if($query != ''){
				echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($produtos).'</b> resultado(s)</p></div>';
			}
			foreach ($produtos as $key => $value) {
		?>
   
   <div id="item-<?php echo $value['id']; ?>" class="box-single-wraper">
       
       <div class="borda" >
           <div  class="box-imgs">
               
               <img class="imag-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'] ?>" alt="">

            </div><!--img-->
            <div style="" class="box-single">
                <div class="body-box">
                    <p><b><i class="fa fa-address-card"></i> Nome </b> <?php echo $value['nome']; ?> </p>
                    <p><b><i class="fa fa-address-card"></i> Tipo:</b> <?php echo $value['tipo']; ?> </p>                    
                    <div class="group-btn">
                        <a class="btn-delete1" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-empreendimentos?deletar=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> </a>
                        <a style="background: #0091ea; border-radius: 0;" class="btn-delete1" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-empreendimento?id=<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Visualizar </a>
                        </div>
                </div>
            </div><!--box-single-->
            <div class="clear"></div>
            </div><!--border-->
        </div><!--box-single-wraper-->
     
    <?php } ?>
    

    </div><!--boxes-->
    

</div><!--box-content-->

