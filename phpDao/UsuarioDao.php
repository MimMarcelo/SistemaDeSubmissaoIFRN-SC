<?php


//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class UsuarioDao{
    
    public static function login($cpf, $senha){
        $resultado = _Conexao::executar("CALL login('$cpf', '$senha')");
        
        if($resultado->num_rows > 0){
            return $resultado;
        }
        else{
            return null;
        }
    }
    
    public static function salvar($pCpf, $pSenha, $pNome, $pEmail, $pMatricula, $pIdNivelAcesso, $pIdStatusInscricao, $pAvaliador, $pImagem, $pIdUsuario){
        
        $resultado = _Conexao::executar("CALL cadastrarUsuario('".$pCpf."', '".$pSenha."', '".$pNome."', '".$pEmail."', '".$pMatricula."', $pIdNivelAcesso, $pIdStatusInscricao, $pAvaliador, '".$pImagem."', $pIdUsuario);");
        
        if($resultado->num_rows > 0){
            return $resultado;
        }
        else{
            return null;
        }
    }
}