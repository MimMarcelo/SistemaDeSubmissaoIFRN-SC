<?php

    require_once dirname(__FILE__).'/../phpClasses/Usuario.php';
    require_once dirname(__FILE__).'/../includes/sessaoDeUsuario.php';
    loginObrigatorio();
    
    function testaCampo($campo) {
        $campo = trim($campo);
        $campo = stripslashes($campo);
        $campo = htmlspecialchars($campo);
        return $campo;
    }
    
    $metodoHttp = $_SERVER['REQUEST_METHOD'];
    $mensagem = array();
    $titulo = "Atenção";
    
    if($metodoHttp == 'POST'){
        $idEvento = 0;
        $nomeEvento = "";
        
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