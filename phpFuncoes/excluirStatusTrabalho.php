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
        $mensagem[] = "Status de inscricao não informado!";
        $titulo = "Atenção";
    }
    
    if(count($mensagem) == 0){
        if(StatusTrabalho::excluirStatusTrabalho($_POST["pIdStatusTrabalho"]) === TRUE){
            $mensagem[] = "Status Id: ".$_POST["pIdStatusTrabalho"]." excluído com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar excluir: ".$_POST["pIdStatusTrabalho"];
            $titulo = "Atenção";
        }
    }
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));