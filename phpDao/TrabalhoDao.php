<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class TrabalhoDao{
    
    /**
     * Grava Trabalho no Banco de dados
     * @param int $idTrabalho
     * @param int $idEvento
     * @param int $idStatusTrabalho
     * @param string $instituicao
     * @param string $titulo
     * @param string $resumo
     * @param string $palavrasChave
     * @param string $arquivo
     * @param string $areasAplicacao Lista de Id (separados por vírgula) das Áreas de atuação do Trabalho
     * @param string $orientadores Lista de Id (separados por vírgula) dos Usuários Orientadores do Trabalho
     * @param string $demaisAutores Lista de Id (separados por vírgula) dos autores do Trabalho
     * @return int Id do Trabalho Gravado
     */
    public static function salvar($idTrabalho, $idEvento, $idStatusTrabalho, $instituicao, $titulo,
                $resumo, $palavrasChave, $arquivo, $areasAplicacao, $orientadores, $demaisAutores) {
        
        $query = "CALL `sistemaifrnsc`.`cadastrarTrabalho`($idTrabalho, $idEvento, $idStatusTrabalho, '$instituicao'"
                . ", '$titulo', '$resumo', '$palavrasChave', '$arquivo', '$areasAplicacao', '$orientadores', '$demaisAutores');";
        
        return _Conexao::executar($query);
    }
    
    public static function getTrabalhosPorUsuario($idUsuario){
        $query = "CALL consultarTrabalhosPorUsuario($idUsuario);";
        return _Conexao::executar($query);
    }
}