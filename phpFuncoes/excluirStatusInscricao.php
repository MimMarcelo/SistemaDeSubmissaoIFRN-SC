<?php

require dirname(__FILE__).'/../phpClasses/StatusInscricao.php';

if(isset($_GET["pIdStatusInscricao"])){
    if(!empty($_GET["pIdStatusInscricao"])){
        if(StatusInscricao::excluirStatusInscricao($_GET["pIdStatusInscricao"]) === TRUE){
            echo "Status Id: ".$_GET["pIdStatusInscricao"]." excluído com sucesso!";
        }
        else{
            echo "Erro ao tentar excluir: ".$_GET["pIdStatusInscricao"];
        }
    }
    else{
        echo "Informe um status de inscricao válido!";
    }
}
else{
    echo "Status de inscricao não informado!";
}