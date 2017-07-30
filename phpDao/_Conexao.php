<?php

class _Conexao{
    
    private $servidor = "localhost";
    private $banco = "sistemaifrnsc";
//    private $usuario = "root";
//    private $senha = "Senha123";
    private $usuario = "sisIfrnSc";
    private $senha = "f3jHjUm@m@r4";
    
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
}