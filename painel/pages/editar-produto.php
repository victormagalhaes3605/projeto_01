<?php 
$id = (int)$_GET['id'];
$sql = Msql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
$sql->execute(array($id));
if($sql->rowCount() == 0){
    Painel::alert('erro','O produto que você quer editar não existe!');
    die();
}

$infoProduto = $sql->fetch();

$pegaImagens = Msql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
$pegaImagens->execute();
$pegaImagens = $pegaImagens->fetchAll();

?>

      
        
     
        <?php 
            if(isset($_GET['deletarImagem'])){
            $idImagem = $_GET['deletarImagem'];
            @unlink(BASE_DIR_PAINEL.'/uploads/'.$idImagem);
            Msql::conectar()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE imagem = '$idImagem'");
            Painel::alert('sucesso','A imagem foi deletada com sucesso!'); 
            $pegaImagens = Msql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
            $pegaImagens->execute();
            $pegaImagens = $pegaImagens->fetchAll();

            
        }
        ?>



<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Editando Produto: <?php echo $id ?></h2>
            <div class="card-title">Imagens do produto</div>

            <div class="boxes">
                <?php 
                    foreach ($pegaImagens as $key => $value){

                  
                ?>    
            
                <div class="box-single-wraper">
                        <div class="borda" >
                        <div style=" margin: 0 auto; " class="box-imgs">
                            <img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL?>/uploads/<?php echo $value['imagem']; ?>">
                            <div style="text-align: center;" class="group-btn">
                
                            <a style="margin-top: 20px;" class="btn-delete1" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem'] ?>"><i class="fa fa-times"></i> </a>
                            
                
                            </div>
                        </div><!--img-->
                        <div style="" class="box-single">
                            
                        </div><!--box-single-->
                        <div class="clear"></div>
                        </div><!--border-->
                    </div><!--box-single-wraper-->
                    
                    <?php } ?>
                </div>
                <div class="card-title">Informações do produto:</div>
    <form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $id; ?>" enctype="multipart/form-data">

    <?php 
        if(isset($_POST['acao'])){
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $largura = $_POST['largura'];
            $altura = $_POST['altura'];
            $comprimento = $_POST['comprimento'];
            $peso = $_POST['peso'];
            $quantidade = $_POST['quantidade'];

            $imagens = [];

            $sucesso = true;

            $amountFiles = count($_FILES['imagem']['name']);
            if($_FILES['imagem']['name'][0] != ''){
            for($i =0; $i < $amountFiles; $i++){
				$imagemAtual = ['type'=>$_FILES['imagem']['type'][$i],
				'size'=>$_FILES['imagem']['size'][$i]];
				if(Painel::imagemValida($imagemAtual) == false){
					$sucesso = false;
					Painel::alert('erro','Uma das imagens selecionadas são inválidas!');
					break;
				}
			}
        }

        if($sucesso){
            if($amountFiles > 0){
            for($i =0; $i < $amountFiles; $i++){
                $imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],
                    'name'=>$_FILES['imagem']['name'][$i]];
                $imagens[] = Painel::uploadFiles($imagemAtual);
            }

            foreach ($imagens as $key => $value) {
                MSql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$id,'$value')");
            }
        }
            $sql = Msql::conectar()->prepare("UPDATE `tb_admin.estoque` SET nome = ?,descricao = ?, altura = ?,
            largura = ?, comprimento = ?, peso = ?, quantidade = ? WHERE id = $id");
            $sql->execute(array($nome,$descricao,$altura,$largura,$comprimento,$peso,$quantidade));
            Painel::alert('sucesso', 'Você atualizou seu produto com sucesso!');
            
            $sql = Msql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
            $sql->execute(array($id));
            $infoProduto = $sql->fetch();
            $pegaImagens = Msql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
			$pegaImagens->execute();
			$pegaImagens = $pegaImagens->fetchAll();

        }
    }
    ?>
        <div class="form-group">
			<label>Nome do produto:</label>
			<input type="text" name="nome" value="<?php echo $infoProduto['nome']; ?>">
		</div><!--form-group-->

        
		<div class="form-group">
			<label>Descrição do produto:</label>
			<textarea name="descricao"><?php echo $infoProduto['descricao']; ?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Largura do produto:</label>
			<input type="number" name="largura" min="0" max="900" step="1" value="<?php echo $infoProduto['largura']; ?>">
		</div><!--form-group-->


		<div class="form-group">
			<label>Altura do produto:</label>
			<input type="number" name="altura" min="0" max="900" step="1" value="<?php echo $infoProduto['altura']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Comprimento do produto:</label>
			<input type="number" name="comprimento" min="0" max="900" step="1" value="<?php echo $infoProduto['comprimento']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Peso do produto:</label>
			<input type="number" name="peso" min="0" max="900" step="1" value="<?php echo $infoProduto['peso']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Quantidade atual do produto:</label>
			<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $infoProduto['quantidade']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Selecione as imagens:</label>
			<input multiple type="file" name="imagem[]">
		</div><!--form-group-->
		<input type="submit" name="acao" value="Cadastrar Produto!">
	</form>

                            
                                  
            
                </div>