<?php

require dirname(__FILE__).'/../phpClasses/StatusTrabalho.php';

if(isset($_GET["pIdStatusTrabalho"])){
    if(!empty($_GET["pIdStatusTrabalho"])){
        if(StatusTrabalho::excluirStatusTrabalho($_GET["pIdStatusTrabalho"]) === TRUE){
            echo "Status Id: ".$_GET["pIdStatusTrabalho"]." excluído com sucesso!";
        }
        else{
            echo "Erro ao tentar excluir: ".$_GET["pIdStatusTrabalho"];
        }
    }
    else{
        echo "Informe um status de inscricao válido!";
    }
}
else{
    echo "Status de inscricao não informado!";
}