<?php
    namespace views;

    final class mainView 
    
    {
        public static $par= [];
        public static function setParam($par){
            self::$par = $par;
        }

        public static function render($fileName,$header = 'pages/includes/header.php',$footer = 'pages/includes/footer.php'){
            include($header);
            include('pages/'.$fileName);
            include($footer);


            die();
        }
    }
    
?>
