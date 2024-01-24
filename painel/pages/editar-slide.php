<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $slides = Painel::select('tb_site.slides','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Slide</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
			

				if($imagem['name'] != ''){
					$usuario = new Usuario();
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFiles($imagem);
                        $arr = ['nome'=>$nome,'slide'=>$imagem , 'order_id'=>'0','nome_tabela'=> 'tb_site.slides'];
                        Painel::insert($arr);
                        $slides = Painel::select('tb_site.slides','id = ?',array($id));
						Painel::alert('sucesso','O Slide foi editado junto com a imagem!');
					}else{
						Painel::alert('erro','O formato nao é valido');
					}
				}else{
					$imagem = $imagem_atual;
					$arr = ['nome'=>$nome,'slide'=>$imagem , 'order_id'=>'0','nome_tabela'=> 'tb_site.slides'];
                        Painel::insert($arr);
                        $slides = Painel::select('tb_site.slides','id = ?',array($id));
                        Painel::alert('sucesso','O Slide foi editado com sucesso!');
				}
            }
        ?>


        <div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" required value="<?php echo $slides['nome']; ?>" required>
		</div><!--form-group-->
		

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $slides['slide']; ?>" required>
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->