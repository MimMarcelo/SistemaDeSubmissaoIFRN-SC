<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnexoDao
 *
 * @author marcelo
 */
class AnexoDao {
    public static function salvar($idEvento, $idTipoArquivo, $arquivo, $descricao){
        $sql = "CALL cadastrarAnexo($idEvento,$idTipoArquivo,'$arquivo', '$descricao');";
        return _Conexao::executar($sql);
    }
    
    public static function getAnexosPorEvento($idEvento, $idTipoAnexo) {
        $sql = "CALL consultarAnexosPorEvento($idEvento, $idTipoAnexo);";
        //echo $sql;
        return _Conexao::executar($sql);
    }
}
