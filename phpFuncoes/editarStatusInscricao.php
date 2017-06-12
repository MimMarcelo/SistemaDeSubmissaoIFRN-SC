<?php

require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

if(isset($_GET["pIdStatusInscricao"])){
    if(!empty($_GET["pIdStatusInscricao"])){
        
        if(isset($_GET["pStatusInscricao"])){
            if(!empty($_GET["pStatusInscricao"])){
                if(StatusInscricao::editarStatusInscricao($_GET["pIdStatusInscricao"], $_GET["pStatusInscricao"]) === TRUE){
                    echo "Status: ".$_GET["pStatusInscricao"]." salvo com sucesso!";
                }
                else{
                    echo "Erro ao tentar salvar: ".$_GET["pStatusInscricao"]." no Id: ".$_GET["pIdStatusInscricao"];
                }
            }
            else{
                echo "Nova descrição para o status '".$_GET["pIdStatusInscricao"]." não informado!";
            }
        }
        else{
            echo "Nova descrição para o status '".$_GET["pIdStatusInscricao"]." não informado!";
        }
    }
    else{
        echo "Informe um status de inscrição válido!";
    }
}
else{
    echo "Status de inscricao não selecionado!";
}