<?php

require_once dirname(__FILE__) . '/../phpDao/AnexoDao.php';

/**
 * Description of Anexo
 *
 * @author marcelo
 */
class Anexo {
    const TODOS = -1;
    const LOGOMARCA = 1;
    const TERMOS_DE_USO = 2;
    const MODELO = 3;
    
    private $idEventoTipoAnexo;
    private $idEvento;
    private $idTipoAnexo;
    private $arquivo;
    private $descricao;

    public function getIdEventoTipoAnexo() {
        return $this->idEventoTipoAnexo;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function getIdTipoAnexo() {
        return $this->idTipoAnexo;
    }

    public function getArquivo() {
        return $this->arquivo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setIdEventoTipoAnexo($idEventoTipoAnexo) {
        $this->idEventoTipoAnexo = $idEventoTipoAnexo;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function setIdTipoAnexo($idTipoAnexo) {
        $this->idTipoAnexo = $idTipoAnexo;
    }

    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function salvar() {
        $mensagem = "Não foi possível cadastrar o anexo '$this->descricao'";
        $dado = AnexoDao::salvar($this->idEvento, $this->idTipoAnexo, $this->arquivo, $this->descricao);
        print_r($dado);
        if ($dado != null) {
            foreach ($dado as $obj) {
                if ($obj["idEventoTipoAnexo"] > 0) {
                    return $obj["idEventoTipoAnexo"];
                }
            }
        }
        return $mensagem;
    }

    public static function getAnexosPorEvento($idEvento, $idTipoAnexo = -1) {
        $mensagem = "Nenhum anexo encontrado";
        $anexos = array();
        
        $dado = AnexoDao::getAnexosPorEvento($idEvento, $idTipoAnexo);
        //print_r($dado);
        if($dado != null){
            foreach ($dado as $obj){
                $a = new Anexo();
                foreach ($obj as $key => $value) {
                    $a->{$key} = $value;
                }
                $anexos[] = $a;
            }
            return $anexos;
        }
        return $mensagem;
    }

}
