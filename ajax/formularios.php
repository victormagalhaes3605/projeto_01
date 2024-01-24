<?php 
include('../config.php');
    $data = array();
    $assunto = 'Nova mensagem do site';
    $corpo = '';
    foreach($_POST as $key => $value){
        $corpo.=ucfirst($key).": ".$value;
        $corpo.="<hr>";
    }
    $info = array('assunto'=>$assunto,'corpo'=>$corpo);
    $mail = new Email('smtp.titan.email','admin@victorwagner.com.br','V@magalhaes15','victor');
    $mail->addAdress('admin@victorwagner.com.br','victor');
    $mail->formatarEmail($info);
     if($mail->enviarEmail()){
        $data['sucesso'] = true;
       }else{
         $data['erro'] = true;
       }

       

       $data['retorno'] = 'sucesso';
    
    die(json_encode($data));
?>