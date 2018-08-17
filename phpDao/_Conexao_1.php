<?php

class _Conexao_1 extends MySQLi{
    
    private $servidor = "10.21.0.00";//"127.0.0.1";
    private $banco = "sistemaifrnsc";
    private $usuario = "sisIfrnSc";
    private $senha = "f3jHjUm@m@r4";
    
    //Conecta usando MySQLi
    public function __construct() {
        parent::__construct($this->servidor, $this->usuario, $this->senha, $this->banco);
        mysqli_set_charset($this, "utf8");
    }

    public function __clone() {
        
    }

    public function __wakeup() {
        
    }

    public static function executar($sql){
        $con = new _Conexao();
        $resultado = $con->query($sql);
        $con->close();
        return $resultado;
    }
}
