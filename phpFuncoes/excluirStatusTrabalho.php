<?php

    require dirname(__FILE__).'/../phpClasses/StatusTrabalho.php';
    $mensagem = array();

    if(isset($_POST["pIdStatusTrabalho"])){
        if(empty($_POST["pIdStatusTrabalho"])){
            $mensagem[] = "Informe um status de inscrição válido!";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não informado!";
    }
    
    if(count($mensagem) == 0){
        if(StatusTrabalho::excluirStatusTrabalho($_POST["pIdStatusTrabalho"]) === TRUE){
            $mensagem[] = "Status Id: ".$_POST["pIdStatusTrabalho"]." excluído com sucesso!";
        }
        else{
            $mensagem[] = "Erro ao tentar excluir: ".$_POST["pIdStatusTrabalho"];
        }
    }
    echo json_encode(array("mensagem" => $mensagem));