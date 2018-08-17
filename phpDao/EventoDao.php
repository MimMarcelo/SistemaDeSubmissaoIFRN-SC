<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

/**
 * Prepara as queries de banco de dados que podem ser executadas pela Classe
 * _Conexao
 *
 * @author Marcelo Júnior
 */
class EventoDao {
    
    /**
     * Cria uma query que permite consultar as Áreas de Atuação gravadas no Banco.
     * Aceitando restrições dadas pelos parâmetros
     * 
     * @param int $idEvento
     * @param string $nome
     * @param string $descricao
     * @param string $inicioInscricao
     * @param string $fimInscricao
     * @param string $inicioSubmissao
     * @param string $fimSubmissao
     * @param string $inicioEvento
     * @param string $fimEvento
     * @param int $idEventoPrincipal
     * @return array Lista dos eventos correspondentes
     */
    public static function getEventos($idEvento, $nome, $descricao, $inicioInscricao, $fimInscricao,
            $inicioSubmissao, $fimSubmissao, $inicioEvento, $fimEvento, $idEventoPrincipal) {
        
        $sql = "CALL consultarEvento($idEvento, '$nome', '$descricao', '$inicioInscricao', '$fimInscricao',"
                . " '$inicioSubmissao', '$fimSubmissao', '$inicioEvento', '$fimEvento', $idEventoPrincipal);";
        //echo "$sql";
        return _Conexao::executar($sql);
    }
    
    /**
     * Prepara instrução SQL para gravar o Evento no banco de dados
     * 
     * @param int $idEvento
     * @param int $idEventoPrincipal
     * @param string $nome
     * @param string $descricao
     * @param string $local
     * @param string $logoMarca
     * @param int $numVagas
     * @param string $inicioInscricao
     * @param string $finalInscricao
     * @param string $inicioSubmissao
     * @param string $finalSubmissao
     * @param string $inicioEvento
     * @param string $finalEvento
     * @return boolean funcionou
     */
    public static function salvar($idEvento, $idEventoPrincipal, $nome, $descricao, 
                                  $local, $logoMarca, $numVagas, $inicioInscricao,
                                  $finalInscricao, $inicioSubmissao, $finalSubmissao,
                                  $inicioEvento, $finalEvento){
        
        $sql = "CALL cadastrarEvento($idEvento, $idEventoPrincipal, '$nome', '$descricao', "
                . "'$local', '$logoMarca', $numVagas, '$inicioInscricao', '$finalInscricao', '$inicioSubmissao', "
                . "'$finalSubmissao', '$inicioEvento', '$finalEvento');";
        
        return _Conexao::executar($sql);
    }
    
    public static function excluirEvento($id){
        return _Conexao::executar("CALL excluirEvento($id)");
    }
    
    
}
