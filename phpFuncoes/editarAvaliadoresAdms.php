<?php

//SESSAO PARA IMPORTS
require_once dirname(__FILE__) . '/../phpClasses/Usuario.php';
require_once dirname(__FILE__) . '/validaCampos.php';

//INICIA AS VARIÁVEIS COM OS VALORES PADRÃO DO FORMULÁRIO
$idUsuarios = '';
$avaliadores = '';
$administradores = '';

//ARRAY QUE LISTA AS MENSAGENS DE ERRO ENCONTRADOS
$metodoHttp = $_SERVER['REQUEST_METHOD'];
$mensagem = array();
$aux = "";
$titulo = "Atenção";

//QUANDO O USUÁRIO REALIZA ALGUMA CONSULTA, VERIFICAR OS CAMPOS QUE FORAM INFORMADOS
if ($metodoHttp == 'POST') {
    foreach($_POST['usuario'] as $idUsuario){
        if($idUsuarios == ''){
            $idUsuarios = ''.$idUsuario;
        }
        else{
            $idUsuarios .=','.$idUsuario;
        }
        if(in_array($idUsuario, $_POST['administrador'])){
            if($administradores == ''){
                $administradores = '1';
            }
            else{
                $administradores .= ',1';
            }
        }
        else{
            if($administradores == ''){
                $administradores = '0';
            }
            else{
                $administradores .= ',0';
            }
        }
        if(in_array($idUsuario, $_POST['avaliador'])){
            if($avaliadores == ''){
                $avaliadores = '1';
            }
            else{
                $avaliadores .= ',1';
            }
        }
        else{
            if($avaliadores == ''){
                $avaliadores = '0';
            }
            else{
                $avaliadores .= ',0';
            }
        }
    }
    //echo $idUsuarios."<br>".$avaliadores."<br>".$administradores;
    if(Usuario::alterarAvaliadoresAdms($idUsuarios, $avaliadores, $administradores)){
        $mensagem[] = "Usuários alterados com sucesso!";
    }
    else{
        $mensagem[] = "Não foi possível realizar a alteração!";
    }
}
echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
