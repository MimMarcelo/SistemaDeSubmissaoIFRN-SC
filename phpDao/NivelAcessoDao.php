<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class NivelAcessoDao{
    
    /**
     * Cria instrução SQL que retorna lista de NivelAcesso, atendendo aos 
     * critérios passados por parâmetro
     * @param int $id
     * @param string $nivelAcesso
     * @return array Lista dos níveis de acesso correspondentes à consulta
     */
    public static function getNivelAcesso($id, $nivelAcesso) {
        $sql = "CALL consultarNivelAcesso($id, '$nivelAcesso')";
        return _Conexao::executar($sql);
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