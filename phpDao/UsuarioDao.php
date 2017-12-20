<?php


//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class UsuarioDao{
    
    public static function login($cpf, $senha){
        return _Conexao::executar("CALL login('$cpf', '$senha')");
    }
    
    public static function salvar($pCpf, $pSenha, $pNome, $pEmail, $pMatricula, $pAvaliador, $pImagem, $pIdNivelAcesso, $pIdUsuario){
        return _Conexao::executar("CALL cadastrarUsuario('".$pCpf."', '".$pSenha."', '".$pNome."', '".$pEmail."', '".$pMatricula."', $pAvaliador, '".$pImagem."', $pIdNivelAcesso, $pIdUsuario);");
    }
    
    public static function inscreverEmEvento($idUsuario, $idEvento){
        return _Conexao::executar("CALL inscreverEmEvento($idUsuario, $idEvento)");
    }
    
    public static function consultarUsuariosPorEvento($idEvento){
        return _Conexao::executar("CALL consultarUsuarioEvento(0, $idEvento, 0, 0)");
    }
}