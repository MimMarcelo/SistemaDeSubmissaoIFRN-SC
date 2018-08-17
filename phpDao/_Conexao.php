<?php

/**
 * A Classe _Conexao é do tipo MySQLi, permitindo estabelecer conexão com o
 * SGBD MySQL
 * 
 * @author Marcelo Júnior
 */
class _Conexao extends MySQLi{
    
    //Singleton
    //Cria variável estática que armazenara uma única instância da classe
    private static $instance = null;
    
    //Propriedades para estabelecer conexão com o banco de dados
    private $servidor = "127.0.0.1";
    private $banco = "sistemaifrnsc";
    private $usuario = "sisIfrnSc";
    private $senha = "f3jHjUm@m@r4";
    
    /**
     * [Padrão: Singleton]
     * Construtor privado para evitar que outras classes criem novas instâncias
     */
    private function __construct() {
        parent::__construct($this->servidor, $this->usuario, $this->senha, $this->banco);
        mysqli_set_charset($this, "utf8");
    }
    
    /**
     * [Padrão: Singleton]
     * Método responsável por obter uma única instância da classe
     * @return _Conexao Object Singleton
     */    
    private static function getInstance() {
        if(!self::$instance instanceof self){
            self::$instance = new _Conexao();
        }
        return self::$instance;
    }

    /**
     * Única interface para as demais classes acessarem _Conexao.
     * Permite a execução que quaisquer instrução SQL
     * @param string $sql Instrução SQL
     * @return Object Retorna o resultado da execução da instrução SQL,
     * que pode ser: int, boolean, array, String de erro.
     */
    public static function executar($sql){
        $resultado = null;      //Receberá o resultado da execução da query, que deve ser fechado
        $retorno = null;        //Armazena o valor que deve ser retornado pela função,
                                //permitindo que $resultado possa ser fechado
        
        $resultado = self::getInstance()->query($sql);  //Executa a instrução SQL
        if(self::getInstance()->error){         //Em caso de erro
            return self::getInstance()->error;  //Retorna String de erro
        }
        
        if($resultado === TRUE){            //Caso o resultado seja um boolean
            $retorno = $resultado;
        }
        elseif(is_object($resultado)){      //Caso o resultado seja um Object
            if($resultado->num_rows > 0){
                $retorno = array();         //Transforma $retorno em array
                while ($row = $resultado->fetch_assoc()) {
                    $retorno[] = $row;
                }
            }
            $resultado->close();            //Fecha o result, que permite que outra consulta possa ser executada
            self::$instance->next_result(); //Espera pela próxima consulta, só é necessário no uso de Singleton
        }
        return $retorno;
    }
    
    /**
     * [Padrão: Singleton]
     * Sobrescrito para impedir que o Object de _Conexao possa ser duplicado
     */
    public function __clone() {
        
    }

    /**
     * [Padrão: Singleton]
     * Sobrescrito para impedir que o Object de _Conexao possa ser duplicado
     */
    public function __wakeup() {
        
    }

}
