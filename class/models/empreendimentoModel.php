<?php
    namespace models;

    Class empreendimentoModel{
        public static function pegaImoveis($id){
            $selectImoveis = \Msql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE empreend_id = $id");
            $selectImoveis->execute(); 
            return $selectImoveis->fetchAll();
        }
    }
?>

