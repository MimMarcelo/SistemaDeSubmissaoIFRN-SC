<?php

    require dirname(__FILE__).'/../phpClasses/StatusTrabalho.php';

    $mensagem = array();
    $titulo = "";

    if(isset($_POST["pIdStatusTrabalho"])){
        if(empty($_POST["pIdStatusTrabalho"])){
            $mensagem[] = "Informe um status de inscrição válido!";
            $titulo = "Atenção";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não selecionado!";
        $titulo = "Atenção";
    }
    
    if(isset($_POST["pStatusTrabalho"])){
        if(empty($_POST["pStatusTrabalho"])){
            $mensagem[] = "Nova descrição para o status '".$_POST["pIdStatusTrabalho"]."' não informada!";
            $titulo = "Atenção";
        }
    }
    else{
        $mensagem[] = "Nova descrição para o status '".$_POST["pIdStatusTrabalho"]." não informada!";
        $titulo = "Atenção";
    }
    
    if(count($mensagem) == 0){
        if(StatusTrabalho::editarStatusTrabalho($_POST["pIdStatusTrabalho"], $_POST["pStatusTrabalho"]) === TRUE){
            $mensagem[] = "Status: ".$_POST["pStatusTrabalho"]." salvo com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusTrabalho"]." no Id: ".$_POST["pIdStatusTrabalho"];
            $titulo = "Atenção";
        }
    }
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));