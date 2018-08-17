<?php

    require_once dirname(__FILE__).'/../phpClasses/Usuario.php';
    session_start();
    
    $usuario = new Usuario();
    
    $metodoHttp = $_SERVER['REQUEST_METHOD'];
    $mensagem = array();
    $titulo = "Atenção";
    
    if(isset($_SESSION["usuario"])){
        $usuario = $_SESSION["usuario"];
    }
    else{
        $mensagem[] = "Login obrigatório!";
    }
    
    if($metodoHttp == 'POST' && count($mensagem) == 0){
        $idEvento = 0;
        $nomeEvento = "";
        //print_r($_POST);
        if(isset($_POST["pIdEvento"])){
            $idEvento = testaCampo($_POST["pIdEvento"]);
        }
        else{
            $mensagem[] = "Evento para inscrição não informado!";
        }
        if(isset($_POST["pEvento"])){
            $nomeEvento = testaCampo($_POST["pEvento"]);
            if(empty($nomeEvento)){
                $mensagem[] = "Evento para inscrição não informado!";
            }
        }
        else{
            $mensagem[] = "Evento para inscrição não informado!";
        }
        
        if(count($mensagem) == 0){
            if($usuario->inscreverEmEvento($idEvento) === TRUE){
                $mensagem[] = "Você foi inscrito no evento ".$nomeEvento." com sucesso!";
                $titulo = "Sucesso";
            }
            else{
                $mensagem[] = "Erro ao tentar inscreve-lo no evento ".$nomeEvento."!";
            }
        }
    }
    else{
        $mensagem[] = "Método HTTP '".$metodoHttp."' ainda não implementado!";
    }
    
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
    
    
    function testaCampo($campo) {
        $campo = trim($campo);
        $campo = stripslashes($campo);
        $campo = htmlspecialchars($campo);
        return $campo;
    }