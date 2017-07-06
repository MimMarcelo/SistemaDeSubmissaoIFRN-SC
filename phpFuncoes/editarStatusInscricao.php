<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

    $mensagem = array();
    $titulo = "";

    if(isset($_POST["pIdStatusInscricao"])){
        if(empty($_POST["pIdStatusInscricao"])){
            $mensagem[] = "Status de inscrição não informado!";
            $titulo = "Atenção";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não selecionado!";
        $titulo = "Atenção";
    }
    
    if(isset($_POST["pStatusInscricao"])){
        if(empty($_POST["pStatusInscricao"])){
            $mensagem[] = "Nova descrição para o status não informado!";
            $titulo = "Atenção";
        }
    }
    else{
        $mensagem[] = "Nova descrição para o status não informado!";
        $titulo = "Atenção";
    }
    
    if(count($mensagem) == 0){
        if(StatusInscricao::editarStatusInscricao($_POST["pIdStatusInscricao"], $_POST["pStatusInscricao"]) === TRUE){
            $mensagem[] = "Status: ".$_POST["pStatusInscricao"]." salvo com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusInscricao"]." no Id: ".$_POST["pIdStatusInscricao"];
            $titulo = "Atenção";
        }
    }
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));