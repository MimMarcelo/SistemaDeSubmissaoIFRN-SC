<?php

require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

if(isset($_GET["pStatusInscricao"])){
    if(!empty($_GET["pStatusInscricao"])){
        if(StatusInscricao::salvarStatusInscricao($_GET["pStatusInscricao"]) === TRUE){
            echo "Status: ".$_GET["pStatusInscricao"]." salvo com sucesso!";
        }
        else{
            echo "Erro ao tentar salvar: ".$_GET["pStatusInscricao"];
        }
    }
    else{
        echo "Informe um status de inscricao válido!";
    }
}
else{
    echo "Status de inscricao não informado!";
}