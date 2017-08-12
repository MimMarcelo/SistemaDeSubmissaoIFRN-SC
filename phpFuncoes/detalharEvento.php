<?php
    require dirname(__FILE__).'/../phpClasses/Evento.php';
    
    $mensagem = array();
    $titulo = "Atenção";

    if(isset($_POST) && !empty($_POST)){
        $mensagem = Evento::getEventoPorId($_POST['pId']);
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
    