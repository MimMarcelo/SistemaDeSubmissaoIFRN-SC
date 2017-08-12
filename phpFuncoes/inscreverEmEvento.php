<?php

    require_once dirname(__FILE__).'/../phpClasses/Usuario.php';
    session_start();
    
    $usuario = new Usuario();
    if(isset($_SESSION["usuario"])){
        $usuario = $_SESSION["usuario"];
    }
    $mensagem = array();
    $titulo = "Atenção";

    if(isset($_POST["pIdEvento"])){
        if(empty($_POST["pIdEvento"])){
            $mensagem[] = "Evento para inscrição não informado!";
        }
    }
    else{
        $mensagem[] = "Evento para inscrição não informado!";
    }
    if(isset($_POST["pEvento"])){
        if(empty($_POST["pEvento"])){
            $mensagem[] = "Evento para inscrição não informado!";
        }
    }
    else{
        $mensagem[] = "Evento para inscrição não informado!";
    }
    
    if(count($mensagem) == 0){
        if($usuario->inscreverEmEvento($_POST["pIdEvento"]) === TRUE){
            $mensagem[] = "Você foi inscrito no evento ".$_POST["pEvento"]." com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar inscreve-lo no evento ".$_POST["pEvento"]."!";
        }
    }
        
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));