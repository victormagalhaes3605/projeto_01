<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php
    $infoSite = Msql::conectar()->prepare("SELECT * FROM `tb_site.config`");
    $infoSite->execute();
    $infoSite = $infoSite->fetch();
?>
<?php
$usuario = Msql::conectar()->prepare("SELECT * FROM `tb_adm.usuarios`");
$usuario->execute();
$usuario = $usuario->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $infoSite['titulo']; ?></title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link  href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<header>
    <base base="<?php echo INCLUDE_PATH; ?>" />
    <?php
    



    $url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'depoimentos':
				echo '<target target="depoimentos" />';
				break;

			case 'servicos':
				echo '<target target="servicos" />';
				break;
		}

     
    ?>
<div class="sucesso">Formulario enviado com sucesso!</div>
<div class="falha">Falha ao enviar!</div>
<div class="overlay-loading">
    <img src="<?php echo INCLUDE_PATH ?>imagens/loading.gif" />
</div><!--overlay-loading-->

		 
			<div class="center">
			<div class="logo left"><a href="<?php echo INCLUDE_PATH; ?>">Logomarca</a></div>
			<nav class="desktop right">
				<ul>
					<li><a title="Home" href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a title="Depoimentos" href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
					<li><a title="Serviços" href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
			 <nav class="mobile right">
			 	<div class="botao-menu-mobile">
			 		<i class="fa fa-bars" aria-hidden="true"></i>
			 	</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
		<div class="clear"></div>
			
  </header>	

	

<div class="container-principal">

<?php
    
    if(file_exists('pages/'.$url.'.php')){
        include('pages/'.$url.'.php');
    }else{
        //Podemos fazer o que quiser, pois a página não existe.
        if($url != 'depoimentos' && $url != 'servicos'){
            $urlPar = explode('/',$url)[0];
            if($urlPar != 'noticias'){
            $pagina404 = true;
            include('pages/404.php');
            }else{
                include('pages/noticias.php');
            }
        }else{
            include('pages/home.php');
        }
    }
    
    

?>
</div><!--container-principal-->

<footer <?php if(isset($pagina404) && $pagina404 == true) echo'class="fixed"'; ?>>
    <div class="center">
        <p>Todos os direitos reservados</p>
    </div><!--center-->
</footer>




<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>


<?php

		if(is_array($url) && strstr($url[0],'noticias') !== false){
	?>
		<script>
			$(function(){
				$('select').change(function(){
					location.href=include_path+"noticias/"+$(this).val();
				})
			})
		</script>
	<?php
		}
	?>
    <?php
		if($url == 'contato'){
	?>
    <?php } ?>
<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>






</body>
</html>