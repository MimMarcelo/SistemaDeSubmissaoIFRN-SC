<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class StatusInscricaoDao{
    
    /**
     * Retorna uma lista de StatusInscricao
     * @param int $id
     * @param string $statusInscricao
     * @return array Lista de StatusInscricao que satisfazem aos parâmetros
     */
    public static function getStatusInscricao($id, $statusInscricao) {
        $sql = "CALL consultarStatusInscricao($id, '$statusInscricao')";
        return _Conexao::executar($sql);
    }
    
    /**
     * Grava StatusInscricao no banco de dados
     * @param string $descricao
     * @return boolean funcionou
     */
    public static function salvarStatusInscricao($descricao) {
        return _Conexao::executar("CALL cadastrarStatusInscricao('$descricao')");
    }
    
    /**
     * Altera o texto de um StatusInscricao baseado em seu Id
     * @param int $id
     * @param string $descricao
     * @return boolean funcionou
     */
    public static function editarStatusInscricao($id, $descricao){
        return _Conexao::executar("CALL alterarStatusInscricao($id, '$descricao')");
    }
    
    /**
     * Exclui StatusInscricao pelo Id
     * @param int $id
     * @return boolean
     */
    public static function excluirStatusInscricao($id){
        return _Conexao::executar("CALL excluirStatusInscricao($id)");
    }
}