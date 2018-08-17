<?php

require_once dirname(__FILE__).'/../phpDao/TrabalhoDao.php';
require_once dirname(__FILE__).'/StatusTrabalho.php';
require_once dirname(__FILE__).'/Evento.php';

/**
 * Description of Trabalho
 *
 * @author marcelo
 */
class Trabalho {
    private $idTrabalho;
    private $idEvento;
    private $idStatusTrabalho;
    private $instituicao;
    private $titulo;
    private $resumo;
    private $palavrasChave;
    private $arquivo;
    private $areasAplicacao;
    private $orientadores;
    private $coAutores;
    private $evento;
        
    public function getIdTrabalho() {
        return $this->idTrabalho;
    }

    public function getInstituicao() {
        return $this->instituicao;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getResumo() {
        return $this->resumo;
    }
    
    public function getPalavrasChave() {
        return $this->palavrasChave;
    }
    
    public function getArquivo() {
        return $this->arquivo;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function getEvento(){
        if(!isset($this->evento)){
            $this->evento = Evento::getEventoPorId($this->idEvento, -1);
        }
        return $this->evento;
    }
    public function getStatusTrabalho() {
        if(!is_object($this->idStatusTrabalho)){
            $this->idStatusTrabalho = StatusTrabalho::getStatusTrabalho($this->idStatusTrabalho, '');
        }
        return $this->idStatusTrabalho;
    }
    
    public function getOrientadores() {
        return $this->orientadores;
    }

    public function getCoAutores() {
        return $this->coAutores;
    }

    public function getAreasAplicacao() {
        return $this->areasAplicacao;
    }

    public function setIdTrabalho($idTrabalho) {
        $this->idTrabalho = $idTrabalho;
    }

    public function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }

    public function setTitulo($titulo) {
        if(empty($titulo)){
            return "Informe o título do trabalho";
        }
        else{
            if(strlen($titulo) < 1){
                return "Informe o título do trabalho";
            }
            else{
                $this->titulo = $titulo;
            }
        }
        return "";
    }

    public function setResumo($resumo) {
        if(empty($resumo)){
            return "Informe o resumo do trabalho";
        }
        else{
            if(strlen($resumo) < 1){
                return "Informe o resumo do trabalho";
            }
            else{
                $this->resumo = $resumo;
            }
        }
        return "";
    }

    public function setPalavrasChave($palavrasChave) {
        $this->palavrasChave = $palavrasChave;
    }

    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function setIdStatusTrabalho($idStatusTrabalho) {
        $this->idStatusTrabalho = $idStatusTrabalho;
    }
    
    public function setOrientadores($orientadores) {
        $this->orientadores = $orientadores;
    }

    public function setCoAutores($coAutores) {
        $this->coAutores = $coAutores;
    }

    public function setAreasAplicacao($areasAplicacao) {
        $this->areasAplicacao = $areasAplicacao;
    }
    
    public function salvar(){
        $orientadores = implode(",", $this->orientadores);
        $autores = implode(",", $this->coAutores);
        $areas = implode(",", $this->areasAplicacao);
        return TrabalhoDao::salvar($this->idTrabalho, $this->idEvento, $this->idStatusTrabalho, $this->instituicao, $this->titulo,
                $this->resumo, $this->palavrasChave, $this->arquivo, $areas, $orientadores, $autores);
    }
    
    public static function getTrabalhosPorUsuario($idUsuario){
        $mensagem = "";
        $trabalhos = array();
        
        $dado = TrabalhoDao::getTrabalhosPorUsuario($idUsuario);// CONSULTA O BANCO DE DADOS
        if($dado == null){
            $mensagem = "Nenhum trabalho encontrado";
        }
        else{
            foreach ($dado as $obj){
                $trabalho = new Trabalho();
                foreach ($obj as $key => $value) {
                    $trabalho->{$key} = $value;
                }
                $trabalhos[] = $trabalho;
            }
        }
        if($mensagem !== ""){
            return $mensagem;
        }
        else{
            return $trabalhos;
        }
    }
}
