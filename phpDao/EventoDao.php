<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

class EventoDao {
    
    //Exemplo que consulta vários registros no banco
    public static function getEventos($idEvento, $nome, $descricao, $inicioInscricao, $fimInscricao, $inicioSubmissao, $fimSubmissao, $inicioEvento, $fimEvento) {
        
        $resultado = _Conexao::executar("CALL consultarEvento($idEvento, '$nome', '$descricao', '$inicioInscricao', '$fimInscricao', '$inicioSubmissao', '$fimSubmissao', '$inicioEvento', '$fimEvento');");
        
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
        }
        return null;
    }
    
    public static function salvar($idEvento, $idEventoPrincipal, $nome, $descricao, 
                                  $local, $logoMarca, $numVagas, $inicioInscricao,
                                  $finalInscricao, $inicioSubmissao, $finalSubmissao,
                                  $inicioEvento, $finalEvento){
        
        $resultado = _Conexao::executar("CALL cadastrarEvento($idEvento, $idEventoPrincipal, '$nome', '$descricao', "
                . "'$local', '$logoMarca', $numVagas, '$inicioInscricao', '$finalInscricao', '$inicioSubmissao', "
                . "'$finalSubmissao', '$inicioEvento', '$finalEvento');");
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
            else{
                return null;
            }
        }
    }
}
