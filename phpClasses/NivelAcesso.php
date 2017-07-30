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
    
    /**
     * CONSULTA TODOS OS NÍVEIS DE ACESSO REGISTRADOS NO BANCO DE DADOS
     * @return array de objetos NivelAcesso
     */
    public static function getTodosNiveisAcesso(){
        $mensagem = array();
        $niveisAcesso = array();
        
        $dados = NivelAcessoDao::getNivelAcesso(0, '');
        if($dados == null){
            $mensagem[] = "Nenhum nível de acesso encontrado!";
        }
        else{
            try{
                while($obj = $dados->fetch_assoc()) {
                    $nivelAcesso = new NivelAcesso();
                    
                    foreach ($obj as $key => $value) {
                        $nivelAcesso->{$key} = $value;
                    }
                    
                    $niveisAcesso[] = $nivelAcesso;
                }
            } catch (Exception $e) {
                $niveisAcesso = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $niveisAcesso;
        }
    }
    
    /**
     * CONSULTA NÍVEL DE ACESSO ATRAVÉS DO ID
     * @param INT $id ID DO NÍVEL DE ACESSO A SER CONSULTADO
     * @return NivelAcesso
     */
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