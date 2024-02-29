<?php
    if(isset($_GET['loggout'])){
        Painel::loggout();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Painel de controle</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">
    <link href="<?php echo INCLUDE_PATH; ?>estilo/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL ?>css/jquery-ui.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<base base="<?php echo INCLUDE_PATH_PAINEL; ?>"/>
    <div class="menu">
    <div class="menu-wraper">
    
        <div class="box-usuario">
            <?php 
                if($_SESSION['img'] == ''){
            ?>
            <div class=avatar-usuario>
                <i class="fa fa-user"></i>
            </div><!--avatar-usuario-->
            <?php }else{ ?>
                <div class="imagem-usuario">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>">
                </div><!--avatar-usuario-->
                <?php } ?>
            <div class= "nome-usuario">
                <p><?php echo $_SESSION['nome'];?></p>
                <p><?php echo pegaCargo($_SESSION['cargo']);?></p>
            </div>
        </div><!--box-usuario-->

        <div class="itens-menu">
                <h2>Cadastro</h2>
                
                <a <?php selecionadoMenu('cadastrar-depoimentos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimentos">Cadastrar Depoimento</a>
                <a <?php selecionadoMenu('cadastrar-servico') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servicos">Cadastrar Serviços</a>
                <a <?php selecionadoMenu('cadastrar-slides') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slider</a>
                <h2>Gestão</h2>
                <a <?php selecionadoMenu('listar-depoimentos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimento</a>
                <a <?php selecionadoMenu('listar-servicos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
                <a <?php selecionadoMenu('listar-slides') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slider</a>
                <h2>Administração do painel</h2>
                <a <?php selecionadoMenu('editar-usuario') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar usuario</a>
                <a <?php selecionadoMenu('adicionar-usuario') ?><?php verificaPermissaoMenu(2) ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar usuarios</a>
                <h2>Configuração geral</h2>
                <a <?php selecionadoMenu('editar-site') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar site</a>
                <h2>Gestão de Notícias</h2>
                <a <?php selecionadoMenu('cadastrar-categorias') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-categorias">Cadastrar Categorias</a>
                <a <?php selecionadoMenu('gerenciar-categorias') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias">Gerenciar Categorias</a>
                <a <?php selecionadoMenu('cadastrar-noticias') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-noticias">Cadastrar Notícias</a>
                <a <?php selecionadoMenu('gerenciar-noticias') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias">Gerenciar Notícias</a>
                <h2>Gestão de clientes</h2>
                <a <?php selecionadoMenu('cadastrar-clientes') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-clientes">Cadastrar clientes</a>
                <a <?php selecionadoMenu('gerenciar-clientes') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-clientes">Gerenciar clientes</a>
                <h2>Controle finaceiro</h2>
                <a <?php selecionadoMenu('visualizar-pagamentos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-pagamentos">Visualizar pagamentos</a>
                <h2>Controle Estoque</h2>
                <a <?php selecionadoMenu('cadastrar-produtos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-produtos">Cadastrar produtos</a>
                <a <?php selecionadoMenu('visualizar-produtos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-produtos">Visualizar produtos</a>
                <h2>Gestão Imovéis</h2>
                <a <?php selecionadoMenu('cadastrar-empreendimento') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-empreendimento">Cadastrar empreendimento</a>
                <a <?php selecionadoMenu('listar-empreendimentos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-empreendimentos">Visualizar empreendimentos</a>

        </div><!--itens menu-->
    </div><!--menu-wrapper-->    
    </div><!--menu-->
    
    
        <header>
            <div class="center">
                <div class="menu-btn">
                    <i class="fa fa-bars"></i>
                </div><!--menu-btn-->

                <div class="loggout">
                    <div class="pg_inicial left">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>?"><i class="fa fa-home"></i>  <span>Pagina inicial</span>   </a>
                    </div>
                    <div class="pg_sair right">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"><i class="fa fa-window-close"></i>  <span>Sair</span>   </a>
                    </div>
                </div><!--loggout-->
                <div class="clear"></div>
        </div> <!--center-->
        </header>

        <div class="content">

              <?php

                Painel::carregarPagina();

              
               
                ?>


        </div><!--content-->
        
<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
<?php Painel::loadJs(array('jquery-ui.min.js'),'listar-empreendimentos'); ?>
<script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.mask.js"></script>    
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.maskMoney.js"></script>    
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.ajaxform.js"></script>    
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/main.js"></script>  
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/empreendimentos.js"></script>  
<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>

<script src="https://cdn.tiny.cloud/1/5fq2vm7o6ex3bgfntioknn4thgge2z2vitr06rbdicrquopq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>  
<script>
  tinymce.init({
    selector: '.tinymce',
 
  });
</script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/helperMask.js"></script> 
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/clientes.js"></script>  
<?php Painel::loadJs(array('ajax.js'),'gerenciar-clientes'); ?>
<?php Painel::loadJs(array('ajax.js'),'cadastrar-clientes'); ?>
<?php Painel::loadJs(array('ajax.js'),'editar-cliente'); ?>
<?php Painel::loadJs(array('controleFinanceiro.js'),'editar-cliente'); ?>

</body>
</html>