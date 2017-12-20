<?php

class Trabalho {
    private $id;
    private $titulo;
    private $resumo;
    private $arquivo;
    private $idEvento;
    private $status;
    
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getResumo() {
        return $this->resumo;
    }

    public function getArquivo() {
        return $this->arquivo;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        if(isset($titulo)){
            if(empty($titulo)){
                return "Informe o título do trabalho";
            }
            else if(strlen($titulo) < 2){
                return "O título deve possuir pelo menos 2 caracteres";
            }
            else{
                $this->$titulo = $titulo;
                return "";
            }
        }
        else{
            return "Informe o título do trabalho";
        }
    }

    public function setResumo($resumo) {
        if(isset($resumo)){
            if(empty($resumo)){
                return "Informe o resumo do trabalho";
            }
            else if(strlen($resumo) < 10){
                return "O resumo deve possuir no mínimo 10 caracteres";
            }
            else{
                $this->resumo = $resumo;       
            }
        }
        else{
            return "Informe o resumo do trabalho";
        }
    }

    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


}
