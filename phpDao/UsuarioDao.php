<?php


//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class UsuarioDao{
    
    /**
     * Verifica se há Usuario com os Login e senha informados
     * @param string $cpf
     * @param string $senha
     * @return array NULL ou array com os dados do Usuario retornado
     */
    public static function login($cpf, $senha){
        $sql = "CALL login('$cpf', '$senha');";
        return _Conexao::executar($sql);
    }
    
    /**
     * Retorna uma lista de Usuario baseado em uma série de parâmetros
     * @param string $cpf
     * @param string $nome
     * @param string $email
     * @param string $matricula
     * @param int $avaliador 1 = Avaliador; 0 = Não é avaliador
     * @param int $administrador 1 = Administrador; 0 = Não é administrador
     * @param int $idUsuario
     * @return array Lista de Usuario correspondente
     */
    public static function consultarUsuario($cpf, $nome, $email, $matricula, $avaliador, $administrador, $idUsuario){ 
        $sql = "CALL consultarUsuario('$cpf', '$nome', '$email', '$matricula', $avaliador, $administrador, $idUsuario)";
        echo "$sql";
        return _Conexao::executar($sql);
    }
    
    /**
     * 
     * @param type $idUsuarios lista dos Ids dos Usuários separados por vírgula
     * @param type $avaliadores lista dos valores de avaliador separados por vírgula
     * @param type $adms lista dos valores de administrador separados por vírgula
     * @return void
     */
    public static function alterarAvaliadoresAdms($idUsuarios, $avaliadores, $adms){ 
        $sql = "CALL alterarAvaliadoresAdms('$idUsuarios', '$avaliadores', '$adms')";
        //echo "$sql";
        return _Conexao::executar($sql);
    }
    
    /**
     * Grava/Altera um dado Usuario no banco de dados
     * @param string $pCpf
     * @param string $pSenha
     * @param string $pNome
     * @param string $pEmail
     * @param string $pMatricula
     * @param int $pAvaliador 1 = Avaliador; 0 = Não é avaliador
     * @param string $pImagem
     * @param int $pIdNivelAcesso 1 = Administrador; 0 = Não é administrador
     * @param int $pIdUsuario Informado só para alterações
     * @param string $areasAtuacao
     * @return int Id do Usuario cadastrado/alterado
     */
    public static function salvar($pCpf, $pSenha, $pNome, $pEmail, $pMatricula, $pAvaliador, $pImagem, $pIdNivelAcesso, $pIdUsuario, $areasAtuacao){
        $sql = "CALL cadastrarUsuario('".$pCpf."', '".$pSenha."', '".$pNome."', '".$pEmail."', '".$pMatricula."', $pAvaliador, '".$pImagem."', $pIdNivelAcesso, $pIdUsuario, '".$areasAtuacao."');";
        return _Conexao::executar($sql);
    }
    
    public static function consultarInscritosPorEvento($idEvento, $idStatusInscricao) {
        
        $sql = "CALL consultarInscritosPorEvento($idEvento, $idStatusInscricao);";
        //echo "$sql";
        return _Conexao::executar($sql);
    }
    public static function credenciar($idUsuario, $idEvento) {
        
        $sql = "CALL credenciar($idUsuario, $idEvento);";
        //echo "$sql";
        return _Conexao::executar($sql);
    }
}