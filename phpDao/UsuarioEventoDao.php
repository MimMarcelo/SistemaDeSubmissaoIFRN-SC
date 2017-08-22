<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

class UsuarioEventoDao{
    
    public static function getUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso){
        return _Conexao::executar("CALL consultarUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso)");
    }
}