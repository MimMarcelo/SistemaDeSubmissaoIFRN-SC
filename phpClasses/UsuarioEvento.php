<?php

    require_once dirname(__FILE__).'/../phpDao/UsuarioEventoDao.php';

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

    public function getIdStatusInscricao() {
        return $this->idStatusInscricao;
    }
    
    public static function getUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso){
        $mensagem = array();
        $listaUsuarioEvento = array();
        
        $dado = UsuarioEventoDao::getUsuarioEvento($idUsuario, $idEvento, $idStatusInscricao, $idNivelAcesso);
        if($dado == null){
            $mensagem[] = "Nenhum registro encontrado!";
        }
        else{
            try{
                while($obj = $dado->fetch_assoc()) {
                    $usuarioEvento = new UsuarioEvento();
            
                    foreach ($obj as $key => $value) {
                        $usuarioEvento->{$key} = $value;
                    }
                    
                    $listaUsuarioEvento[] = $usuarioEvento;
                }
            } catch (Exception $e) {
                $listaUsuarioEvento = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $listaUsuarioEvento;
        }
    }
}