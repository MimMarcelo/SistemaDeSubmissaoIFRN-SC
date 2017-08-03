<?php

    require dirname(__FILE__).'/../phpClasses/StatusTrabalho.php';

    $mensagem = array();
    $titulo = "Atenção";

    if(isset($_POST["pStatusTrabalho"])){
        if(empty($_POST["pStatusTrabalho"])){
            $mensagem[] = "Informe um status de inscricao válido!";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não informado!";
    }
    if(count($mensagem) == 0){
        if(StatusTrabalho::salvarStatusTrabalho($_POST["pStatusTrabalho"]) === TRUE){
            $mensagem[] = "Status: '".$_POST["pStatusTrabalho"]."' salvo com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar salvar: ".$_POST["pStatusTrabalho"];
        }
    }
    
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));