<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

class UsuarioEventoDao{
    
    public static function getUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso){
        $resultado = _Conexao::executar("CALL consultarUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso)");
        
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
        }
        return null;
    }
}