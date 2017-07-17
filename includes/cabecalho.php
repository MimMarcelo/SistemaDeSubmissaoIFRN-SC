<?php
    require dirname(__FILE__).'/../phpClasses/Usuario.php';
    session_start();
    $usuario = null;
    if(isset($_SESSION["usuario"])){
        $usuario = $_SESSION["usuario"];
    }
    else{
        $_SESSION["mensagem"] = "Você precisa fazer login para acessar o sistema!";
        header("location: ".htmlspecialchars("index.php"));
    }
    
?>
<header>
    <h1>Sistema de Submissão - IFRN SC</h1>
    <h2>Bem vindo <?php echo $usuario->getNome(); ?>!</h2>
    <a href="phpFuncoes/logout.php">(Sair)</a>
</header>
