<?php

    require_once dirname(__FILE__).'/../phpClasses/Usuario.php';
    require_once dirname(__FILE__).'/../includes/popup.php'; 
    require_once dirname(__FILE__).'/../phpClasses/Evento.php';
    session_start();
    
    $usuario = new Usuario();
    if(isset($_SESSION["usuario"])){
        $usuario = $_SESSION["usuario"];
    }
    
    /*
     * TODA PÁGINA QUE POSSUIR UM FORMULÁRIO PRECISA DESSE INCLUDE
     */
    //print_r($_SESSION);
    if(isset($_SESSION["mensagem"]) && $_SESSION["mensagem"] !== null){
        echo "<script>abrePopup('Atenção', '".$_SESSION["mensagem"]."');</script>";
        $_SESSION["mensagem"] = null;
    }
    
    function loginObrigatorio(){
        global $usuario;
        if(empty($usuario->getId())){
            $_SESSION["mensagem"] = "Você precisa fazer login para acessar o sistema!";
            header("location: index.php");
        }
    }
?>
