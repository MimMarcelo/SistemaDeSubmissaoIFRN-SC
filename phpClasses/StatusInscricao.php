<?php

    require_once dirname(__FILE__).'/../phpDao/StatusInscricaoDao.php';

class StatusInscricao{
    private $idStatusInscricao;
    private $descricao;
    
    public function getId(){
        return $this->idStatusInscricao;
    }
    
    public function setId($id){
        $this->idStatusInscricao = $id;
    }
    
    public function getStatusInscricao(){
        return $this->descricao;
    }
    
    public function setStatusInscricao($statusInscricao){
        $this->descricao = $statusInscricao;
    }
    
    public static function getTodosStatusInscricao(){
        $mensagem = array();
        $listaStatusInscricao = array();
        
        $dados = StatusInscricaoDao::getStatusInscricao(0, '');
        if($dados == null){
            $mensagem[] = "Nenhum status de inscricao encontrado!";
        }
        else{
            try{
                while($obj = $dados->fetch_assoc()) {
                    $statusInscricao = new StatusInscricao();
                    
                    foreach ($obj as $key => $value) {
                        $statusInscricao->{$key} = $value;
                    }
                    
                    $listaStatusInscricao[] = $statusInscricao;
                }
            } catch (Exception $e) {
                $listaStatusInscricao = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $listaStatusInscricao;
        }
    }
    
    public static function getStatusInscricaoPorId($id){
        $mensagem = array();
        $statusInscricao = null;
        
        $dado = StatusInscricaoDao::getStatusInscricao($id, '');
        if($dado == null){
            $mensagem[] = "Status Inscricao não encontrado!";
        }
        else{
            $statusInscricao = new StatusInscricao();
            try{
                while($obj = $dado->fetch_assoc()) {
                    foreach ($obj as $key => $value) {
                        $statusInscricao->{$key} = $value;
                    }
                }
            } catch (Exception $e) {
                $statusInscricao = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $statusInscricao;
        }
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