<?php

require dirname(__FILE__).'/../phpClasses/StatusTrabalho.php';

if(isset($_GET["pIdStatusTrabalho"])){
    if(!empty($_GET["pIdStatusTrabalho"])){
        
        if(isset($_GET["pStatusTrabalho"])){
            if(!empty($_GET["pStatusTrabalho"])){
                if(StatusTrabalho::editarStatusTrabalho($_GET["pIdStatusTrabalho"], $_GET["pStatusTrabalho"]) === TRUE){
                    echo "Status: ".$_GET["pStatusTrabalho"]." salvo com sucesso!";
                }
                else{
                    echo "Erro ao tentar salvar: ".$_GET["pStatusTrabalho"]." no Id: ".$_GET["pIdStatusTrabalho"];
                }
            }
            else{
                echo "Nova descrição para o status '".$_GET["pIdStatusTrabalho"]." não informado!";
            }
        }
        else{
            echo "Nova descrição para o status '".$_GET["pIdStatusTrabalho"]." não informado!";
        }
    }
    else{
        echo "Informe um status de inscrição válido!";
    }
}
else{
    echo "Status de inscricao não selecionado!";
}