<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

    $mensagem = array();
    $titulo = "Atenção";

    if(isset($_POST["pStatusInscricao"])){
        if(empty($_POST["pStatusInscricao"])){  
            $mensagem[] = "Informe um status de inscrição válido!";
        }
    }
    else{
        $mensagem[] = "Status de inscrição não informado!";
    }    
    if(count($mensagem) == 0){
        if(StatusInscricao::salvarStatusInscricao($_POST["pStatusInscricao"]) === TRUE){
            $mensagem[] = "Status: '".$_POST["pStatusInscricao"]."' salvo com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusInscricao"];
        }
    }
    
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));