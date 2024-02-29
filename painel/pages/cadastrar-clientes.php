<?php 
    verificarPermissaoPagina(2);

    $cargos = [
        '0' => 'normal',
        '1' => 'Sub Administrador',
        '2' => 'Administrador'

    ]
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Clientes</h2>

    <form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">

   

				
            
    


        <div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome"  >
		</div><!--form-group-->
		<div class="form-group">
			<label>E-mail:</label>
			<input type="text" name="email" >
		</div><!--form-group-->
        
		<div class="form-group">
			<label>Tipo:</label>
			<select name="tipo_cliente" id="">
               <option value="fisico">Físico</option>
               <option value="juridico">juridico</option>
            </select>
		</div><!--form-group-->
		<div ref="cpf" class="form-group">
			<label>CPF</label>
			<input type="text" name="cpf" />
            
		</div><!--form-group-->
		<div ref="cnpj" style="display:none;" class="form-group">
			<label>CNPJ</label>
			<input type="text" name="cnpj" />
            
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
            <input type="hidden" name="tipo_acao" value="cadastrar_cliente">
        </div>

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->