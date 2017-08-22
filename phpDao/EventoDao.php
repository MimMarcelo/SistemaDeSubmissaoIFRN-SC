<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

class EventoDao {
    
    //Exemplo que consulta vários registros no banco
    public static function getEventos($idEvento, $nome, $descricao, $inicioInscricao, $fimInscricao, $inicioSubmissao, $fimSubmissao, $inicioEvento, $fimEvento) {
        return _Conexao::executar("CALL consultarEvento($idEvento, '$nome', '$descricao', '$inicioInscricao', '$fimInscricao', '$inicioSubmissao', '$fimSubmissao', '$inicioEvento', '$fimEvento');");
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
