<?php

require dirname(__FILE__).'/../phpClasses/StatusTrabalho.php';

if(isset($_GET["pStatusTrabalho"])){
    if(!empty($_GET["pStatusTrabalho"])){
        if(StatusTrabalho::salvarStatusTrabalho($_GET["pStatusTrabalho"]) === TRUE){
            echo "Status: ".$_GET["pStatusTrabalho"]." salvo com sucesso!";
        }
        else{
            echo "Erro ao tentar salvar: ".$_GET["pStatusTrabalho"];
        }
    }
    else{
        echo "Informe um status de inscricao válido!";
    }
}
else{
    echo "Status de inscricao não informado!";
}