<?php
    namespace models;

    Class homeModel{
        public static function pegaImoveis(){
            $selectImoveis = \Msql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis`");
            $selectImoveis->execute(); 
            return $selectImoveis->fetchAll();
        }
    }
?>

