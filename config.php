<?php  

session_start();
$autoload = function ($class) {
    if ($class == 'Email') {
    require('vendor/autoload.php');
    }
    include('class/' . $class . '.php');
    };
        
        
        spl_autoload_register($autoload);
    

    define('INCLUDE_PATH','http://localhost/php/projeto_01/');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

    define('BASE_DIR_PAINEL',__DIR__.'/painel');
    
    //conectar banco de dados!!!!
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','sistema');


    // variaveis cargo painel


    //funçoes do painel
    


    function pegaCargo($indice){
        
     
            return Painel::$cargos[$indice];
    }

    function selecionadoMenu($par){
        /*<i class="fa fa-angel-double-right"  aria-hidden="true"></i>*/
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par){
            echo 'class = menu-active';
        }
    }

    function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
           echo 'style="display:none;"';
        }
    }

    function verificarPermissaoPagina($permissao) {
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
           include('painel/pages/permissao_negada.php');
           die();
        }
    }

    function recoverPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }

?>