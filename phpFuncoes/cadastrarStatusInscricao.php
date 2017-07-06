<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

    $mensagem = array();
    //$sucesso = true;

    if(isset($_POST["pStatusInscricao"])){
        if(empty($_POST["pStatusInscricao"])){  
            $mensagem[] = "Informe um status de inscricao válido!";
            //$sucesso = false;
        }
    }
    else{
        $mensagem[] = "Status de inscrição não informado!";
        //$sucesso = false;
    }
    
    if(count($mensagem) == 0){
        if(StatusInscricao::salvarStatusInscricao($_POST["pStatusInscricao"]) === TRUE){
            $mensagem[] = "Status: ".$_POST["pStatusInscricao"]." salvo com sucesso!";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusInscricao"];
            //$sucesso = false;
        }
    }
    echo json_encode(array("mensagem" => $mensagem));
    //echo json_encode(array("mensagem" => $mensagem, "sucesso" => $sucesso));