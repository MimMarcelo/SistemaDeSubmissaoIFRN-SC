<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';
    
    $mensagem = array();
    $titulo = "";

    if(isset($_POST["pIdStatusInscricao"])){
        if(empty($_POST["pIdStatusInscricao"])){
            $mensagem[] = "Informe um status de inscricao válido!";
            $titulo = "Atenção";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não informado!";
        $titulo = "Atenção";
    }
    
    if(count($mensagem) == 0){
        if(StatusInscricao::excluirStatusInscricao($_POST["pIdStatusInscricao"]) === TRUE){
            $mensagem[] = "Status Id: ".$_POST["pIdStatusInscricao"]." excluído com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar excluir: ".$_POST["pIdStatusInscricao"];
            $titulo = "Atenção";
        }
    }
    
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));