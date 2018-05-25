<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class StatusInscricaoDao{
    
    //Exemplo que consulta vários registros no banco
    public static function getStatusInscricao($id, $statusInscricao) {
        $resultado = _Conexao::executar("CALL consultarStatusInscricao($id, '$statusInscricao')");
        
        if($resultado->num_rows > 0){
            return $resultado;
        }
        else{
            return null;
        }
    }
    
    //Exemplo que insere no banco
    //Este exemplo também é válido para UPDATE e DELETE
    public static function salvarStatusInscricao($descricao) {
        return _Conexao::executar("CALL cadastrarStatusInscricao('$descricao')");
    }
    
    public static function editarStatusInscricao($id, $descricao){
        return _Conexao::executar("CALL alterarStatusInscricao($id, '$descricao')");
    }
    
    public static function excluirStatusInscricao($id){
        return _Conexao::executar("CALL excluirStatusInscricao($id)");
    }
}