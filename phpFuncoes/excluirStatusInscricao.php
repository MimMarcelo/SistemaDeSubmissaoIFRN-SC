<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';
    $mensagem = array();

    if(isset($_POST["pIdStatusInscricao"])){
        if(empty($_POST["pIdStatusInscricao"])){
            $mensagem[] = "Informe um status de inscricao válido!";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não informado!";
    }
    
    if(count($mensagem) == 0){
        if(StatusInscricao::excluirStatusInscricao($_POST["pIdStatusInscricao"]) === TRUE){
            $mensagem[] = "Status Id: ".$_POST["pIdStatusInscricao"]." excluído com sucesso!";
        }
        else{
            $mensagem[] = "Erro ao tentar excluir: ".$_POST["pIdStatusInscricao"];
        }
    }
    
    echo json_encode(array("mensagem" => $mensagem));