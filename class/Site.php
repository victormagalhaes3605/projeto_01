<?php
    class Site{
        public static function updateUsuarioOnline(){
            if(isset($_SESSION['online'])){
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H:i:s');
                $check = Msql::conectar()->prepare("SELECT `id` FROM `tb_adm.online` WHERE token = ?");
                $check->execute(array($_SESSION['online']));

                if($check->rowCount() == 1){
                    $sql = Msql::conectar()->prepare("UPDATE `tb_adm.online` SET ultima_acao = ? WHERE token = ?");
                    $sql->execute(array($horarioAtual,$token));
                }else{
                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                        }
                    $token = $_SESSION['online'];
                    $horarioAtual = date('Y-m-d H:i:s');
                    $sql = Msql::conectar()->prepare("INSERT INTO `tb_adm.online` VALUES (null,?,?,?)");
                    $sql->execute(array($ip,$horarioAtual,$token));
                }

            }else{
                $_SESSION['online'] = uniqid();
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    };
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H:i:s');
                $sql = Msql::conectar()->prepare("INSERT INTO `tb_adm.online` VALUES (null,?,?,?)");
                $sql->execute(array($ip,$horarioAtual,$token));
            }
        }

        public static function contador(){
            if(!isset($_COOKIE['visita'])){
                setcookie('visita','true',time() + (60*60*24*7));
                $sql = Msql::conectar()->prepare("INSERT INTO `tb_admin.visitas` VALUES (NULL,?,?)");
                $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
            }
        }
    }
?>