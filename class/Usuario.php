<?php
    class Usuario{
        public function atualizarUsuario($nome,$senha,$imagem){
            $sql = Msql::conectar()->prepare("UPDATE `tb_adm.usuarios` SET nome = ?, password = ?, img = ? WHERE user = ?");
            if($sql->execute(array($nome,$senha,$imagem,$_SESSION['user']))){
                return true;
            }else{
                return false;
            }
        }

        public static function usuarioExiste($user){
        $sql = Msql::conectar()->prepare("SELECT `id` FROM  `tb_adm.usuarios` WHERE user = ?");
        $sql->execute(array($user));
        if($sql->rowCount() == 1)
            return true;
        else
            return false;
        }

        public static function cadastrarUsuario($user,$senha,$imagem,$nome,$cargo){
            $sql = Msql::conectar()->prepare("INSERT INTO `tb_adm.usuarios` VALUES (null,?,?,?,?,?)");
            $sql->execute(array($user,$senha,$imagem,$nome,$cargo));
        }
    }
?>