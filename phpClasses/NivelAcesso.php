<?php

    require_once dirname(__FILE__).'/../phpDao/NivelAcessoDao.php';

class NivelAcesso{
    private $idNivelAcesso;
    private $descricao;
    
    public function getId(){
        return $this->idNivelAcesso;
    }
    
    public function setId($id){
        $this->idNivelAcesso = $id;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    public static function getTodosNiveisAcesso(){
        return getNivelAcessoPorId(0);
    }
    
    public static function getNivelAcessoPorId($id){
        $mensagem = array();
        $nivelAcesso = null;
        
        $dado = NivelAcessoDao::getNivelAcesso($id, '');
        if($dado == null){
            $mensagem[] = "Nível de acesso não encontrado!";
        }
        else{
            $nivelAcesso = new NivelAcesso();
            try{
                while($obj = $dado->fetch_assoc()) {
                    foreach ($obj as $key => $value) {
                        $nivelAcesso->{$key} = $value;
                    }
                }
            } catch (Exception $e) {
                $nivelAcesso = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $nivelAcesso;
        }
    }
    
//    public static function salvarNivelAcesso($descricao){
//        return StatusInscricaoDao::salvarNivelAcesso($descricao);
//    }
//    
//    public static function editarNivelAcesso($id, $novaDescircao){
//        return StatusInscricaoDao::editarNivelAcesso($id, $novaDescircao);
//    }
//    
//    public static function excluirNivelAcesso($id){
//        return StatusInscricaoDao::excluirNivelAcesso($id);
//    }
}