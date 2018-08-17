<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class StatusTrabalhoDao{
    
    
    /**
     * Retorna uma lista de StatusTrabalho
     * @param int $id
     * @param string $statusTrabalho
     * @return array Lista de StatusTrabalho que satisfazem aos parâmetros
     */
    public static function getStatusTrabalho($id, $statusTrabalho) {
        $sql = "CALL consultarStatusTrabalho($id, '$statusTrabalho')";
        //echo $sql;
        return _Conexao::executar($sql);
    }
    
    /**
     * Grava StatusTrabalho no banco de dados
     * @param string $descricao
     * @return boolean funcionou
     */
    public static function salvarStatusTrabalho($descricao) {
        return _Conexao::executar("CALL cadastrarStatusTrabalho('$descricao')");
    }
    /**
     * Altera o texto de um StatusTrabalho baseado em seu Id
     * @param int $id
     * @param string $descricao
     * @return boolean funcionou
     */
    public static function editarStatusTrabalho($id, $descricao){
        return _Conexao::executar("CALL alterarStatusTrabalho($id, '$descricao')");
    }
    
    /**
     * Exclui StatusTrabalho pelo Id
     * @param int $id
     * @return boolean
     */
    public static function excluirStatusTrabalho($id){
        return _Conexao::executar("CALL excluirStatusTrabalho($id)");
    }
}