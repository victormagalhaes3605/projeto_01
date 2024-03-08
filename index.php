<?php 
include('config.php'); 
Site::updateUsuarioOnline(); 
Site::contador(); 

$homeController = new controller\homeController();
$empreendimentoController = new controller\empreendimentoController();


Router::get('/',function() use ($homeController){
	$homeController->index();
});

Router::get('/?',function($par) use ($empreendimentoController){
	$empreendimentoController->index($par);
});


?>