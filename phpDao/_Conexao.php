<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class _Conexao{
    
    private $servidor = "localhost";
    private $banco = "sistemaifrnsc";
    private $usuario = "root";
    private $senha = "Senha123";
    
    //Conecta usando MySQLi
    private function getConexao(){
        return new mysqli($this->servidor, $this->usuario, $this->senha, $this->banco);
    }
    
    public static function executar($sql){
        $obj = new _Conexao();
        $con = $obj->getConexao();
        $resultado = $con->query($sql);
        $con->close();
        return $resultado;
    }
    
    public static function executarVarias($sql){
        $obj = new _Conexao();
        $con = $obj->getConexao();
        $con->multi_query($sql);
        while ($con->next_result()) { }
        $resultado = $con->store_result();
        
        $con->close();
        
        return $resultado;
    }
}