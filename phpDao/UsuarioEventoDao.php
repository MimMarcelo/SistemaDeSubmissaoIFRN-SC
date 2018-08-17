<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class UsuarioEventoDao{
    
    /**
     * Retorna uma lista do relacionamento de Usuario e Evento com base nos parâmetros
     * @param int $idUsuario
     * @param int $idEvento
     * @param int $idStatusInscricao
     * @param int $idNivelAcesso
     * @return array Lista de Usuario de um dado Evento, ou Lista de Evento que um Usuario está inscrito
     */
    public static function getUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso){
        $sql = "CALL consultarUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso)";
        return _Conexao::executar($sql);
    }
    
    /**
     * Grava relacionamento do Usuario com um dado Evento
     * @param int $idUsuario
     * @param int $idEvento
     * @return boolean funcionou
     */
    public static function inscreverEmEvento($idUsuario, $idEvento){
        return _Conexao::executar("CALL inscreverEmEvento($idUsuario, $idEvento)");
    }
}