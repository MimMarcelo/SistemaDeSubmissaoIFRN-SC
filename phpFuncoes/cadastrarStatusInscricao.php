<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

    $mensagem = array();
    $titulo = "";

    if(isset($_POST["pStatusInscricao"])){
        if(empty($_POST["pStatusInscricao"])){  
            $mensagem[] = "Informe um status de inscrição válido!";
            $titulo = "Atenção";
        }
    }
    else{
        $mensagem[] = "Status de inscrição não informado!";
        $titulo = "Atenção";
    }
    
    if(count($mensagem) == 0){
        if(StatusInscricao::salvarStatusInscricao($_POST["pStatusInscricao"]) === TRUE){
            $mensagem[] = "Status: ".$_POST["pStatusInscricao"]." salvo com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusInscricao"];
            $titulo = "Atenção";
        }
    }
    //echo json_encode(array("mensagem" => $mensagem));
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));