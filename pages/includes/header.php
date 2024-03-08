<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Portal imobiliário</title>
</head>
<body>
<base base="<?php echo INCLUDE_PATH;  ?>">

<header>
    <div class="container">
    <div class="logo">Portao Imobi</div>

    <nav class="desktop">
        <ul>
        <?php 
           $selectEmpreend = \Msql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` ORDER BY  order_id ASC");
           $selectEmpreend->execute(); 
           $empreedimentos = $selectEmpreend->fetchAll();
           foreach($empreedimentos as $key => $value){
        ?>
            <li><a href="<?php echo INCLUDE_PATH.$value['slug'];?>"><?php echo $value['nome']; ?></li></a>
           
        <?php } ?>
        </ul>
    </nav>
    <div class="clear"></div>

    </div><!--container-->
</header>

<section class="search1">
    <div class="container">
        <h2>O que você procura?</h2>
        <input type="text" name="texto-busca">
    </div>
</section>

<section class="search2">
    <div class="container">
        <form action="<?php echo INCLUDE_PATH ?>ajax/formularios.php" method="post">
            <div class="form-group">
                <label >Area minima: </label>
                <input type="number" name="area_minima" id="">
            </div><!--form-group-->
            <div class="form-group">
                <label >Area máxima: </label>
                <input type="number" name="area_maxima" id="">
            </div><!--form-group-->
            <div class="form-group">
                <label >Preço minimo: </label>
                <input  name="preco_min" type="text">
            </div><!--form-group-->
            <div  class="form-group">
                <label >Preço máximo: </label>
                <input  name="preco_max" type="text">
            </div><!--form-group-->
            <div class="clear"></div>
        </form>
    </div>
</section>
