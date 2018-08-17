<?php

    require dirname(__FILE__).'/../phpClasses/Usuario.php';

require dirname(__FILE__) . '/validaCampos.php';

$metodoHttp = $_SERVER['REQUEST_METHOD'];
$mensagem = array();
$aux = "";
$titulo = "Atenção";

if ($metodoHttp == 'POST') {
    $idUsuario = 0;
    $idEvento = 0;
    
    //VERIFICA SE OS CAMPOS FORAM PREENCHIDOS
    if (isset($_POST["pIdUsuario"])) {
        $idUsuario = testaCampo($_POST["pIdUsuario"]);
    } else {
        $mensagem[] = "Usuário não informado";
    }

    if (isset($_POST["pIdEvento"])) {
        $idEvento = testaCampo($_POST["pIdEvento"]);
    } else {
        $mensagem[] = "Evento não informado";
    }
    
    if(count($mensagem) == 0){
        if(Usuario::credenciar($idUsuario, $idEvento) === TRUE){
            $mensagem[] = "Credenciamento realizado com sucesso!";
            $titulo = "Sucesso";
        }
        else{
            $mensagem[] = "Erro ao tentar realizar o credenciamento";
        }
    }
}
    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));