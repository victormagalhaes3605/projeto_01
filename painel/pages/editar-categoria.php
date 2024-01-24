<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $categoria = Painel::select('tb_site.categorias','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Categoria</h2>

    <form method="post" enctype="multipart/form-data">

    <?php 
            if(isset($_POST['acao'])){
                $slug = Painel::generateSlug($_POST['nome']);
                $arr = array_merge($_POST,array('slug'=>$slug));
                $verificar = Msql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ? AND id != ?");
                $verificar->execute(array($_POST['nome'],$id));
                if($verificar->rowCount() == 1){
                    Painel::alert('erro', 'já existe uma categoria com esse nome');
                }else{
                if(painel::update($arr)){
                    Painel::alert('sucesso','O Atualização da categoria foi realizado com sucesso');
                    $categoria = Painel::select('tb_site.categorias','id = ?', array($id));
                }else{
                    Painel::alert('erro','Campos invalidos nao são permitidos!');
                }
              
            }

        }   
            
        ?>

        <div class="form-group">
			<label>Categoria:</label>
			<input type="text" name="nome" value="<?php echo $categoria['nome'] ?>">
		</div><!--form-group-->

        

        

		<div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.categorias">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->