<?php 

session_start();
date_default_timezone_set('America/Sao_Paulo');
require('vendor/autoload.php');
$autoload = function($class){
    if($class == 'Email'){
        require('vendor/autoload.php');
    }
    include('class/'.$class.'.php');
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

?>