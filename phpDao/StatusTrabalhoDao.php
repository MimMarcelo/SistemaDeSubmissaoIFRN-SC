<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class StatusTrabalhoDao{
    
    //Exemplo que consulta vários registros no banco
    public static function getStatusTrabalho($id, $statusTrabalho) {
        return _Conexao::executar("CALL consultarStatusTrabalho($id, '$statusTrabalho')");
    }
    
    //Exemplo que insere no banco
    //Este exemplo também é válido para UPDATE e DELETE
    public static function salvarStatusTrabalho($descricao) {
        return _Conexao::executar("CALL cadastrarStatusTrabalho('$descricao')");
    }
    
    public static function editarStatusTrabalho($id, $descricao){
        return _Conexao::executar("CALL alterarStatusTrabalho($id, '$descricao')");
    }
    
    public static function excluirStatusTrabalho($id){
        return _Conexao::executar("CALL excluirStatusTrabalho($id)");
    }
}