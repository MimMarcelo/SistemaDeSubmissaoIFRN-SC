<?php

    require_once dirname(__FILE__).'/../phpDao/UsuarioEventoDao.php';
    require_once dirname(__FILE__).'/StatusInscricao.php';

class UsuarioEvento{
    private $idUsuarioEvento;
    private $idUsuario;
    private $idEvento;
    private $idNivelAcesso;
    private $idStatusInscricao;
    
    public function getIdUsuarioEvento() {
        return $this->idUsuarioEvento;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function getIdNivelAcesso() {
        return $this->idNivelAcesso;
    }

    public function getStatusInscricao() {
        if(!($this->idStatusInscricao instanceof StatusInscricao)){
            $this->idStatusInscricao = StatusInscricao::getStatusInscricaoPorId($this->idStatusInscricao);
        }
        return $this->idStatusInscricao;
    }
    
    public static function getUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso){
        $mensagem = "";
        $listaUsuarioEvento = array();
        
        $dado = UsuarioEventoDao::getUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso);
        //print_r($dado);
        if($dado == null){
            $mensagem = "Nenhum registro encontrado!";
        }
        else{
            try{
                foreach ($dado as $obj){
                    $usuarioEvento = new UsuarioEvento();
            
                    foreach ($obj as $key => $value) {
                        $usuarioEvento->{$key} = $value;
                    }
                    $listaUsuarioEvento[] = $usuarioEvento;
                }
            } catch (Exception $e) {
                $listaUsuarioEvento = null;
                $mensagem = $e->getMessage();
            }
        }
        if($mensagem != ""){
            return $mensagem;
        }
        else{
            return $listaUsuarioEvento;
        }
    }
    
    public static function getTodosUsuariosEvento($idEvento){
        return UsuarioEvento::getUsuarioEvento(0, $idEvento, 0, 0);
    }
    
    public static function inscreverEmEvento($idUsuario, $idEvento){
        //echo $idUsuario." - ".$idEvento;
        return UsuarioEventoDao::inscreverEmEvento($idUsuario, $idEvento);
    }
    
}