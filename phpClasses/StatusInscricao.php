<?php

    require_once dirname(__FILE__).'/../phpDao/StatusInscricaoDao.php';

class StatusInscricao{
    private $id;
    private $statusInscricao;
    
	function __construct($id, $descricao){
		$this->id = $id;
		$this->descricao = $descricao;

	}

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getStatusInscricao(){
        return $this->statusInscricao;
    }
    
    public function setStatusInscricao($statusInscricao){
        $this->statusInscricao = $statusInscricao;
    }
    
    public static function getTodosStatusInscricao(){
        return StatusInscricaoDao::getStatusInscricao(0, '');
    }
    
    public static function salvarStatusInscricao($descricao){
        return StatusInscricaoDao::salvarStatusInscricao($descricao);
    }
    
    public static function editarStatusInscricao($id, $novaDescircao){
        return StatusInscricaoDao::editarStatusInscricao($id, $novaDescircao);
    }
    
    public static function excluirStatusInscricao($id){
        return StatusInscricaoDao::excluirStatusInscricao($id);
    }
}