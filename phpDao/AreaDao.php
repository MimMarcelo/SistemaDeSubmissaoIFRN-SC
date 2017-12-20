<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';

class AreaDao{
    
    public static function consultarAreas($id, $area) {
        return _Conexao::executar("CALL consultarAreas($id, '$area')");
    }
}