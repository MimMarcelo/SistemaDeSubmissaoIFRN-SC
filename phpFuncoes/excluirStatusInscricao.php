<?php

    require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';
    
    $mensagem = array();
    $titulo = "Atenção";
    $pId = 0;
    $status = "";
    
    if(isset($_POST["pId"])){
        if(empty($_POST["pId"])){
            $mensagem[] = "Informe um status de inscrição válido!";
        }
    }
    else{
        $mensagem[] = "Status de inscricao não informado!";
    }
    
    if(count($mensagem) == 0){
        if(isset($_POST["pDesc"])){
            if(empty($_POST["pDesc"])){
                $status = $_POST["pId"];
            }
            else{
                $status = $_POST["pDesc"];
            }
        }
        if(StatusInscricao::excluirStatusInscricao($_POST["pId"]) === TRUE){
            $mensagem[] = "Status: '".$status."' excluído com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar excluir: '".$status."'";
        }
    }
    
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));