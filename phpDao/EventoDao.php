<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

class EventoDao {
    
    //Exemplo que consulta vários registros no banco
    public static function getEventos($idEvento, $principal, $nome, $descricao, $inicioInscricao, $fimInscricao, $inicioSubmissao, $fimSubmissao, $inicioEvento, $fimEvento) {
        return _Conexao::executar("CALL consultarEvento($idEvento, 0, $principal, '$nome', '$descricao', '$inicioInscricao', '$fimInscricao', '$inicioSubmissao', '$fimSubmissao', '$inicioEvento', '$fimEvento');");
    }
    
    public static function getSubEventos($idEventoPrincipal){
        return _Conexao::executar("CALL consultarEvento(0, $idEventoPrincipal, 0, '', '', '', '', '', '', '', '');");
    }

    public static function salvar($idEvento, $idEventoPrincipal, $nome, $descricao, 
                                  $local, $logoMarca, $numVagas, $inicioInscricao,
                                  $finalInscricao, $inicioSubmissao, $finalSubmissao,
                                  $inicioEvento, $finalEvento){
        
        return _Conexao::executar("CALL cadastrarEvento($idEvento, $idEventoPrincipal, '$nome', '$descricao', "
                . "'$local', '$logoMarca', $numVagas, '$inicioInscricao', '$finalInscricao', '$inicioSubmissao', "
                . "'$finalSubmissao', '$inicioEvento', '$finalEvento');");
    }
    
    public static function excluirEvento($id){
        return _Conexao::executar("CALL excluirEvento($id)");
    }
}
