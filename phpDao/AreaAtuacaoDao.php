<?php

//IMPORTE DO ARQUIVO QUE GERENCIA O BANCO DE DADOS
require_once '_Conexao.php';


/**
 * Description of AreaAtuacaoDao
 *
 * @author Marcelo Júnior
 */
class AreaAtuacaoDao {
    public static function getAreaAtuacao($id, $areaAtuacao) {
        $resultado = _Conexao::executar("CALL consultarAreaAtuacao($id, '$areaAtuacao')");
        
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
        }
        return null;
    }
    
    public static function getAreasPorIdUsuario($idUsuario){
        $resultado = _Conexao::executar("CALL consultarAreasPorIdUsuario($idUsuario)");
        
        if(is_object($resultado)){
            if($resultado->num_rows > 0){
                return $resultado;
            }
        }
        return null;
    }
}
