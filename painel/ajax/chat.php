<?php
include('../../includeConstant.php');

    $data['sucesso'] = true;
    $data['mensagem'] = "";

    if(Painel::logado() == false){
        die("Você não está logado!");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == 'inserir_mensagem'){

        $mensagem = $_POST['mensagem'];
        $nome = $_SESSION['nome'];
        $id_user = $_SESSION['id_user'];
        
        
        $sql = Msql::conectar()->prepare("INSERT INTO `tb_admin.chat` VALUES (null,?,?)");
        $sql->execute(array($id_user,$mensagem));
        
        if(isset($id_user)){
            echo '<div  style="text-align: right;" class="mensagem-chat">
            <span >'.$nome.':</span>
            <p>'.$mensagem.'</p>
            </div><!--mensagem-chat-->';
            $_SESSION['lastIdChat'] = Msql::conectar()->lastInsertId();
        }

    }else if(isset($_POST['acao']) && $_POST['acao'] == 'pegarMensagens'){
        //recuperar msgs!

        $lastId = $_SESSION['lastIdChat'];

        $sql = Msql::conectar()-> prepare("SELECT * FROM `tb_admin.chat`WHERE id > $lastId");
        $sql->execute();
        $mensagens = $sql->fetchAll();
        $mensagens = array_reverse($mensagens);
        foreach($mensagens as $key => $value) {
        $nomeUsuario = Msql::conectar()->prepare("SELECT nome FROM `tb_adm.usuarios` WHERE id = $value[user_id]");
        $nomeUsuario->execute();
        $nomeUsuario = $nomeUsuario->fetch()['nome'];
          
            echo '<div ;" class="mensagem-chat">
            <span>'.$nomeUsuario.':</span>
			<p>'.$value['mensagem'].'</p>
            </div><!--mensagem-chat-->';

            $_SESSION['lastIdChat'] = $value['id'];
            
        
        }

    }

?>