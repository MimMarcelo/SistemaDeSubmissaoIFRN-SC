<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class NivelAcessoDao{
    
    //Exemplo que consulta vários registros no banco
    public static function getNivelAcesso($id, $nivelAcesso) {
        $resultado = _Conexao::executar("CALL consultarNivelAcesso($id, '$nivelAcesso')");
        
        if($resultado->num_rows > 0){
            return $resultado;
        }
        else{
            return null;
        }
    }
    
//    public static function salvarNivelAcesso($descricao) {
//        return _Conexao::executar("CALL cadastrarNivelAcesso('$descricao')");
//    }
//    
//    public static function editarNivelAcesso($id, $descricao){
//        return _Conexao::executar("CALL alterarNivelAcesso($id, '$descricao')");
//    }
//    
//    public static function excluirNivelAcesso($id){
//        return _Conexao::executar("CALL excluirNivelAcesso($id)");
//    }
}