<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $servicos = Painel::select('tb_site.servicos','id = ?',array($id));
    }else{
        Painel::alert('erro','Voce precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Serviço</h2>

    <form method="post" enctype="multipart/form-data">

    <?php 
            if(isset($_POST['acao'])){
                if(painel::update($_POST)){
                    if(Painel::update($_POST)){
                    Painel::alert('sucesso','O Atualização do serviços foi realizado com sucesso');
                    $servicos = Painel::select('tb_site.servicos','id = ?', array($id));
                }else{
                    Painel::alert('erro','Campos invalidos nao são permitidos!');
                }
              
            }

                
            }
        ?>

        <div class="form-group">
			<label>Servico:</label>
			<textarea  name="servicos"><?php echo $servicos['servicos'];?></textarea>
		</div><!--form-group-->

        

        

		<div class="form-group">
            <input type="hidden" name="id" value="<?php echo $servicos['id']; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->