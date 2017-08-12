<?php

    require dirname(__FILE__).'/../phpClasses/Evento.php';
    
    $mensagem = array();
    $titulo = "Atenção";
    $pId = 0;
    $evento = "";
    
    if(isset($_POST["pId"])){
        if(empty($_POST["pId"])){
            $mensagem[] = "Informe um evento válido!";
        }
    }
    else{
        $mensagem[] = "Evento não informado!";
    }
    
    if(count($mensagem) == 0){
        if(isset($_POST["pDesc"])){
            if(empty($_POST["pDesc"])){
                $evento = $_POST["pId"];
            }
            else{
                $evento = $_POST["pDesc"];
            }
        }
        if(Evento::excluirEvento($_POST["pId"]) === TRUE){
            $mensagem[] = "Evento: '".$evento."' excluído com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar excluir: '".$evento."'";
        }
    }
    
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));