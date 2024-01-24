<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $noticias = Painel::select('tb_site.noticias','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Notícia</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
				$titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $categoria = $_POST['categoria_id'];
				$imagem = $_FILES['capa'];
				$imagem_atual = $_POST['imagem_atual'];
                $verifica = Msql::conectar()->prepare("SELECT `id` FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? AND id != ?");
                $verifica->execute(array($titulo,$categoria,$id));
			
                if($verifica->rowCount() == 0){
                    if($imagem['name'] != ''){
                        $usuario = new Usuario();
                        if(Painel::imagemValida($imagem)){
                            Painel::deleteFile($imagem_atual);
                            $imagem = Painel::uploadFiles($imagem);
                            $slug = Painel::generateSlug($titulo);
                            $arr = ['titulo'=>$titulo,'categoria_id'=>$categoria,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
                            Painel::update($arr);
                            $noticias = Painel::select('tb_site.noticias','id = ?',array($id));
                            Painel::alert('sucesso','A notícia foi editada junto com a imagem!');
                        }else{
                            Painel::alert('erro','O formato nao é valido');
                        }
                    }else{
                        $imagem = $imagem_atual;
                        $slug = Painel::generateSlug($titulo);
                        $arr = ['titulo'=>$titulo,'data'=>date('Y-m-d'),'categoria_id'=>$categoria,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=> 'tb_site.noticias'];
                        Painel::update($arr);
                        $noticias = Painel::select('tb_site.noticias','id = ?',array($id));
                        Painel::alert('sucesso','A notícia foi editada com sucesso!');
                    }
                    }else{
                    Painel::alert('erro','Já existe uma noticia com esse nome');
                    }
                }   
        ?>


        <div class="form-group">
			<label>titulo:</label>
			<input type="text" name="titulo" required value="<?php echo $noticias['titulo']; ?>" required>
		</div><!--form-group-->

        <div class="form-group">
			<label>Conteudo</label>
			<textarea class="tinymce" name="conteudo" id="" cols="30" rows="10" required><?php echo $noticias['conteudo']; ?></textarea>
		</div><!--form-group-->

        <div class="form-group">
            <label>Categoria:</label>
                <select name="categoria_id" id="">
                    <?php
                        $categorias = Painel::selectAll('tb_site.categorias');
                        foreach ($categorias as $key => $value){
                    ?>
                    <option <?php if($value['id'] == $noticias['categoria_id'])  echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
                    <?php    } ?>

                </select>
            </div><!--form-group-->

		

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="capa"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $noticias['capa']; ?>" required>
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->