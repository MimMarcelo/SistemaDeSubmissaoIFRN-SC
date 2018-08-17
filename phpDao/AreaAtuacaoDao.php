<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class AreaAtuacaoDao {
    
    /**
     * Cria uma query que permite consultar as Áreas de Atuação gravadas no Banco.
     * Aceitando restrições de Id e/ou nome da Área desejada
     * @param int $id
     * @param String $areaAtuacao
     * @return array Lista com as Áreas de atuação retornadas pela query
     */
    public static function getAreaAtuacao($id, $areaAtuacao) {
        $sql = "CALL consultarAreaAtuacao($id, '$areaAtuacao')";
        return _Conexao::executar($sql);
    }
    
    /**
     * Cria uma query que permite consultar as Áreas de Atuação vinculadas a um
     * dado Usuário
     * @param int $idUsuario Id do Usuário
     * @return array Lista das Áreas de atuação ligadas ao Usuário
     */
    public static function getAreasPorIdUsuario($idUsuario){
        $sql = "CALL consultarAreasPorIdUsuario($idUsuario)";
        return _Conexao::executar($sql);
    }
}
