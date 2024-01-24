<?php 
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = Msql::conectar()->prepare("SELECT * FROM `tb_adm.usuarios` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));
            if($sql->rowCount() == 1){
                $info = $sql->fetch();
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['img'] = $info['img'];
                header('Location: '.INCLUDE_PATH_PAINEL);
                die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="<?php INCLUDE_PATH_PAINEL ?>css/style.css" rel="stylesheet">
</head>
<body>
    
    <div class="box-login">
        <?php
            if(isset($_POST['acao'])){
                $user = $_POST['user'];
                $password = $_POST['senha'];
                $sql = Msql::conectar()->prepare("SELECT * FROM `tb_adm.usuarios` WHERE user = ? AND password = ?");
                $sql->execute(array($user,$password));
                if($sql->rowCount() == 1){
                    $info = $sql->fetch();
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    $_SESSION['cargo'] = $info['cargo'];
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['img'] = $info['img'];

                    if(isset($_POST['lembrar'])){
                        setcookie('lembrar',true,time()+ (60*60*24), '/');
                        setcookie('user',$user,time()+ (60*60*24), '/');
                        setcookie('password',$password,time()+ (60*60*24), '/');
                    }

                    header('Location: '.INCLUDE_PATH_PAINEL);
                    die();
                }else {
                    echo '<div class="erro-box">Usuario ou senha incorretos!</div>';
                }
                

            }
        ?>
        <h2>Efetue o login</h2>
        <form action="" method="post">
            <input type="text" name="user" placeholder="login..." required>
            <input type="password" name="senha" placeholder="senha..." required>
            <div class="form-group-login left">
                <input type="submit" value="logar" name="acao">
            </div><!--form-froup-login-->
            <div class="form-group-login right">
                <label for="">lembrar-me</label>
                <input type="checkbox" name="lembrar" id="">
            </div><!--form-froup-login-->
            <div class="clear"></div>
        </form>

    </div><!--box-login-->

</body>
</html>