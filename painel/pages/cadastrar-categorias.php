<?php 
   

    
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Categoria</h2>

    <form method="post" enctype="multipart/form-data">

    <?php 
            include('../class/lib/WideImage.php');
            if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
	

                if($nome == ''){
                    Painel::alert('erro','O campo nome esta vazio!');
                }else{
                    $verificar = Msql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ? ");
                    $verificar->execute(array($_POST['nome']));
                    if($verificar ->rowCount() == 0){

                        $slug = Painel::generateSlug($nome);
                        $arr = ['nome'=>$nome,'slug'=>$slug , 'order_id'=>'0','nome_tabela'=> 'tb_site.categorias'];
                        Painel::insert($arr);
                        Painel::alert('sucesso','O cadastro da Categoria foi realizado com sucesso!');
                    }else{
                        Painel::alert('erro','Já existe uma categoria com esse nome!');
                    }
                    
                }
				
            }
        ?>

    <div class="form-group">
			<label>Nome da Categoria</label>
			<input type="text" name="nome"  >
		</div><!--form-group-->


		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->