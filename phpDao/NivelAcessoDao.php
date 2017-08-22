<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class NivelAcessoDao{
    
    //Exemplo que consulta vários registros no banco
    public static function getNivelAcesso($id, $nivelAcesso) {
        return _Conexao::executar("CALL consultarNivelAcesso($id, '$nivelAcesso')");
    }
}