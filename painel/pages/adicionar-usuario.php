<?php 
    verificarPermissaoPagina(2);

    $cargos = [
        '0' => 'normal',
        '1' => 'Sub Administrador',
        '2' => 'Administrador'

    ]
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Adicionar usuario</h2>

    <form method="post" enctype="multipart/form-data">

    <?php 
            if(isset($_POST['acao'])){
                $login = $_POST['login'];
				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$cargo = $_POST['cargo'];

                if($login == ''){
                    Painel::alert('erro','O login está vazio');
                }else if($nome == ''){
                    Painel::alert('erro','O nome está vazio');
                }else if($senha == ''){
                    Painel::alert('erro','A senha está vazia');
                }else if($cargo == ''){
                    Painel::alert('erro','O cargo precisa ser selecionado');
                }else if($imagem['name'] == ''){
                    Painel::alert('erro','A imagem precisa ser selecionada');
                }else{
                    if($cargo >= $_SESSION['cargo']){
                        Painel::alert('erro','Voce precisa selecionar um cargo menor que eo seu');
                    }else if(Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O formato especificado nao esta correto');
                    }else if(Usuario::usuarioExiste($login)){
                        Painel::alert('erro','O usuario já existe');
                    }else{
                        $usuario = new Usuario();
                        $imagem = Painel::uploadFiles($imagem);
                        $usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
                        Painel::alert('sucesso','O cadastro do usuario '.$login.' foi realizado com sucesso');
                    }

                }
				
               

				
            }
        ?>

    <div class="form-group">
			<label>Login:</label>
			<input type="text" name="login"  >
		</div><!--form-group-->

        <div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome"  >
		</div><!--form-group-->
		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password" >
		</div><!--form-group-->
        
		<div class="form-group">
			<label>cargo:</label>
			<select name="cargo" id="">
                <?php 
                    foreach(Painel::$cargos as $key => $value){
                        if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->