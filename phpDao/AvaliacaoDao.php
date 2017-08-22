<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**********************
 * CLASSE DE EXEMPLO DE ACESSO AO BANCO DE DADOS
 */
class AvaliacaoDao{
    
    /**
     * RETORNA AVALIAÇÕES DADOS ALGUNS PARÂMETROS
     * @param type $idEvento ID DO EVENTO PARA O QUAL O TRABALHO FOI SUBMETIDO
     * @param type $idTrabalho ID DO TRABALHO O QUAL SE DESEJA CONSULTAR AS AVALIAÇÕES
     * @param type $idAvaliacao ID DA AVALIAÇÃO QUE SE DESEJA CONSULTAR
     * @param type $idUsuario ID DO USUÁRIO AVALIADOR
     * @param type $idStatusTrabalho ID DO STATUS O QUAL O TRABALHO SE ENCONTRA
     * @param type $concluida 0 PARA AVALIAÇÕES PARCIAIS; 1 PARA AVALIAÇÕES CONCLUÍDAS; QUALQUER OUTRO NÚMERO PARA AMBAS AS SITUAÇÕES
     * @param type $ehFinal 0 PARA AVALIAÇÕES PARA APROVAÇÃO EM EVENTO; 1 PARA AVALIAÇÕES DE TRABALHOS DO EVENTO
     * @param type $titulo (PARTE DO) TÍTULO DO TRABALHO
     * @param type $resumo (PARTE DO) RESUMO DO TRABALHO
     */
    public static function getAvaliacoes($idEvento, $idTrabalho, $idAvaliacao, $idUsuario, $idStatusTrabalho, $concluida, $ehFinal, $titulo, $resumo) {
        return _Conexao::executar("CALL consultarAvaliacao($idEvento, $idTrabalho, $idAvaliacao, $idUsuario, $idStatusTrabalho, $concluida, $ehFinal, '$titulo', '$resumo');");
    }
    
    public static function avaliarTrabalho($idUsuarioAvaliador, $idAvaliacao, $nota, $comentario, $final){
        return _Conexao::executar("CALL avaliarTrabalho($idUsuarioAvaliador, $idAvaliacao, $nota, '$comentario', $final);");
        
    }
    
    public static function cadastrarAvaliacao($idTrabalho, $ehFinal, $idUsuarios){
        return _Conexao::executar("CALL cadastrarAvaliacao($idTrabalho, $ehFinal, $idUsuarios);");
        
    }
}