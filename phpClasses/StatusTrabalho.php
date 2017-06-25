<?php

    require_once dirname(__FILE__).'/../phpDao/StatusTrabalhoDao.php';
class StatusTrabalho {

    private $id;
    private $descricao;

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

    public function getDescricao(){
            return $this->descricao;
    }

    public function setDescricao($descricao){
            $this->descricao = $descricao;
    }

    public static function getTodosStatusTrabalho(){
        return StatusTrabalhoDao::getStatusTrabalho(0, '');
    }
    
    public static function getStatusTrabalho($id, $statusTrabalho) {
        return StatusTrabalhoDao::getStatusTrabalho($id, $statusTrabalho);
    }

    public static function salvarStatusTrabalho($descricao){
        return StatusTrabalhoDao::salvarStatusTrabalho($descricao);
    }
    
    public static function editarStatusTrabalho($id, $novaDescircao){
        return StatusTrabalhoDao::editarStatusTrabalho($id, $novaDescircao);
    }
    
    public static function excluirStatusTrabalho($id){
        return StatusTrabalhoDao::excluirStatusTrabalho($id);
    }
}
