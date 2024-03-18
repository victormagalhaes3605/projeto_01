<div class="box-content">

    <h2><i class="fa fa-comments"></i> Chat</h2>
    <div class="box-chat-online">

    
    <?php
        $mensagens = Msql::conectar()->prepare("SELECT * FROM  `tb_admin.chat` ORDER BY id DESC LIMIT 10");
        $mensagens->execute();
        $mensagens = $mensagens->fetchAll();
        $mensagens = array_reverse($mensagens);
        foreach ($mensagens as $key => $value){
        $nomeUsuario = Msql::conectar()->prepare("SELECT nome FROM `tb_adm.usuarios` WHERE id = $value[user_id]");
        $nomeUsuario->execute();
        $nomeUsuario = $nomeUsuario->fetch()['nome'];
        $lastId=$value['id'];
        
    ?>
        <div class="mensagem-chat">
            <span><?php echo $nomeUsuario ?></span>
            <p><?php echo $value['mensagem'] ?></p>
        </div><!--mensagem-chat-->

        
    <?php 
        $_SESSION['lastIdChat'] = $lastId;
    } ?>
        
    </div><!--box-chat-online-->
    <form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/chat.php">
        <textarea name="mensagem" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Enviar!" name="acao" value="enviar">
    </form>

</div>