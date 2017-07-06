<?php

    require dirname(__FILE__).'/../phpClasses/StatusTrabalho.php';

    $mensagem = array();

    if(isset($_POST["pIdStatusTrabalho"])){
        if(empty($_POST["pIdStatusTrabalho"])){
            $mensagem[] = "Informe um status de inscrição válido!";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não selecionado!";
    }
    
    if(isset($_POST["pStatusTrabalho"])){
        if(empty($_POST["pStatusTrabalho"])){
            $mensagem[] = "Nova descrição para o status '".$_POST["pIdStatusTrabalho"]."' não informada!";
        }
    }
    else{
        $mensagem[] = "Nova descrição para o status '".$_POST["pIdStatusTrabalho"]." não informada!";
    }
    
    if(count($mensagem) == 0){
        if(StatusTrabalho::editarStatusTrabalho($_POST["pIdStatusTrabalho"], $_POST["pStatusTrabalho"]) === TRUE){
            $mensagem[] = "Status: ".$_POST["pStatusTrabalho"]." salvo com sucesso!";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusTrabalho"]." no Id: ".$_POST["pIdStatusTrabalho"];
        }
    }
    echo json_encode(array("mensagem" => $mensagem));