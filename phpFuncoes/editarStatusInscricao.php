<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

    $mensagem = array();

    if(isset($_POST["pIdStatusInscricao"])){
        if(empty($_POST["pIdStatusInscricao"])){
            $mensagem[] = "Status de inscrição não informado!";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não selecionado!";
    }
    
    if(isset($_POST["pStatusInscricao"])){
        if(empty($_POST["pStatusInscricao"])){
            $mensagem[] = "Nova descrição para o status não informado!";
        }
    }
    else{
        $mensagem[] = "Nova descrição para o status não informado!";
    }
    
    if(count($mensagem) == 0){
        if(StatusInscricao::editarStatusInscricao($_POST["pIdStatusInscricao"], $_POST["pStatusInscricao"]) === TRUE){
            $mensagem[] = "Status: ".$_POST["pStatusInscricao"]." salvo com sucesso!";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusInscricao"]." no Id: ".$_POST["pIdStatusInscricao"];
        }
    }
    echo json_encode(array("mensagem" => $mensagem));