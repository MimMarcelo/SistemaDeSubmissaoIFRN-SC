<?php


//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class UsuarioDao{
    
    public static function login($cpf, $senha){
        $resultado = _Conexao::executar("CALL login('$cpf', '$senha')");
        
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
        }
        return null;
    }
    public static function consultarUsuario($cpf, $nome, $email, $matricula, $avaliador, $administrador, $idUsuario){ 
        $resultado = _Conexao::executar("CALL consultarUsuario('$cpf', '$nome', '$email', '$matricula', $avaliador, $administrador, $idUsuario)");
        
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
        }
        return null;
    }
    public static function salvar($pCpf, $pSenha, $pNome, $pEmail, $pMatricula, $pAvaliador, $pImagem, $pIdNivelAcesso, $pIdUsuario){
        //echo "CALL cadastrarUsuario('".$pCpf."', '".$pSenha."', '".$pNome."', '".$pEmail."', '".$pMatricula."', $pAvaliador, '".$pImagem."', $pIdNivelAcesso, $pIdUsuario);";
        $resultado = _Conexao::executar("CALL cadastrarUsuario('".$pCpf."', '".$pSenha."', '".$pNome."', '".$pEmail."', '".$pMatricula."', $pAvaliador, '".$pImagem."', $pIdNivelAcesso, $pIdUsuario);");
        
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
        }
        return null;
    }
    
    public static function inscreverEmEvento($idUsuario, $idEvento){
        return _Conexao::executar("CALL inscreverEmEvento($idUsuario, $idEvento)");
    }
}