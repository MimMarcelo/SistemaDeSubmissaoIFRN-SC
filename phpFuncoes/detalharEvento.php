<?php
    require dirname(__FILE__).'/../phpClasses/Evento.php';
    
    $mensagem = array();
    $titulo = "Atenção";
    //print_r($_POST);
    if(isset($_POST) && !empty($_POST)){
        if(isset($_POST['pIdPrincipal'])){
            $mensagem = Evento::getEventoPorId($_POST['pId'], $_POST['pIdPrincipal']);
        }
        else{
            $mensagem = Evento::getEventoPorId($_POST['pId']);
        }
        //print_r($mensagem);
        if($mensagem instanceof Evento){
            session_start();
            $_SESSION["evento"] = $mensagem;
            //print_r($mensagem);
            echo json_encode(array("redirecionarConteudo" => "detalharEvento.php", "titulo" => $mensagem->getNome()));
        }
        else if(count($mensagem) > 0){
            echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
        }
    }
    