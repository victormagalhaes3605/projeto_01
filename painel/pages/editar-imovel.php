<?php 
$id = (int)$_GET['id'];
$sql = Msql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE id = ?");
$sql->execute(array($id));
if($sql->rowCount() == 0){
    Painel::alert('erro','O imovel que você quer editar não existe!');
    die();
}

$infoimovel = $sql->fetch();

$pegaImagens = Msql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $id");
$pegaImagens->execute();
$pegaImagens = $pegaImagens->fetchAll();

?>

      
        
   
   



<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Editando imovel: <?php echo $id ?></h2>
           
                <div class="card-title">Informações do imovel:</div>
                
                <?php
	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL.'/uploads/'.$idImagem);
		Msql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE imagem = '$idImagem'");
		Painel::alert('sucesso','A imagem foi deletada com sucesso!');
		$pegaImagens = Msql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $id");
		$pegaImagens->execute();
		$pegaImagens = $pegaImagens->fetchAll();
	}else if(isset($_GET['deletarImovel'])){
		foreach ($pegaImagens as $key => $value) {
			@unlink(BASE_DIR_PAINEL.'/uploads/'.$value['imagem']);
		}
		Msql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE imovel_id= $id");
		Msql::conectar()->exec("DELETE FROM `tb_admin.imoveis` WHERE id = $id");
		Painel::alertJS("O imóvel foi deletado com sucesso!");
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-empreendimentos');
	}
	?>
       
    <form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome do imovel:</label>
			<input type="text" name="nome" value="<?php echo $infoimovel['nome']; ?>">
		</div><!--form-group-->
        
		
		<div class="form-group">
			<label>Área:</label>
			<input type="number" name="area" min="0" max="2000" step="100" value="<?php echo $infoimovel['area']; ?>">
		</div><!--form-group-->
		<div class="form-group">
			<label>Preco:</label>
			<input type="text" name="preco" value="<?php echo $infoimovel['preco'];?>">
		</div><!--form-group-->
		<div class="form-group">
			<label>Selecione Imagens:</label>
			<input type="file" multiple name="imagens[]">
		</div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar Imóvel!">
            <a style="padding: 8px 4px; border-radius: 0;" class="btn-delete1" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $id; ?>&deletarImovel=<?php echo $id ?>"><i class="fa fa-times"></i>Excluir </a>
	
		</div><!--form-group-->

	</form>


    <div class="card-title">Imagens do imovel</div>

<div class="boxes">
    <?php 
        foreach ($pegaImagens as $key => $value){

      
    ?>    

    <div class="box-single-wraper">
            <div class="borda" >
            <div style=" margin: 0 auto; " class="box-imgs">
                <img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL?>/uploads/<?php echo $value['imagem']; ?>">
                <div style="text-align: center;" class="group-btn">
    
                <a style="margin-top: 20px;" class="btn-delete1" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem'] ?>"><i class="fa fa-times"></i> </a>
                
    
                </div>
            </div><!--img-->
            <div style="" class="box-single">
                
            </div><!--box-single-->
            <div class="clear"></div>
            </div><!--border-->
        </div><!--box-single-wraper-->
        
        <?php } ?>
    </div>
                            
                                  
            
                </div>