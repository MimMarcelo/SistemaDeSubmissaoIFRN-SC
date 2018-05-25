<?php

    require_once dirname(__FILE__).'/_Util.php';
    require_once dirname(__FILE__).'/../phpDao/EventoDao.php';

class Evento {
    //atributos da classe Evento
    private $idEvento;
    private $idEventoPrincipal;
    private $nome;
    private $descricao;
    private $local;
    private $logoMarca;
    private $numVagas;
    private $inicioInscricao;
    private $finalInscricao;
    private $inicioSubmissao;
    private $finalSubmissao;
    private $inicioEvento;
    private $finalEvento;
    
    public function getIdEvento() {
        return $this->idEvento;
    }

    public function getIdEventoPrincipal() {
        return $this->idEventoPrincipal;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getLocal() {
        return $this->local;
    }

    public function getLogoMarca() {
        if($this->logoMarca==""){
            return "../iconSemImagem.png";
        }
        return $this->logoMarca;
    }

    public function getNumVagas() {
        return $this->numVagas;
    }

    public function getInicioInscricao() {
        return $this->inicioInscricao;
    }

    public function getFinalInscricao() {
        return $this->finalInscricao;
    }

    public function getInicioSubmissao() {
        return $this->inicioSubmissao;
    }

    public function getFinalSubmissao() {
        return $this->finalSubmissao;
    }

    public function getInicioEvento() {
        return $this->inicioEvento;
    }

    public function getFinalEvento() {
        return $this->finalEvento;
    }
    
    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function setIdEventoPrincipal($idEventoPrincipal) {
        if(isset($idEventoPrincipal)){
            if(empty($idEventoPrincipal)){
                $this->idEventoPrincipal = 0;//PADRÃO É ZERO
            }
            else{
                $this->idEventoPrincipal = $idEventoPrincipal;
            }
        }
        else{
            $this->idEventoPrincipal = 0;
        }
        
    }

    public function setNome($nome) {
        if(isset($nome)){
            if(empty($nome)){
                return "Informe o nome do evento";
            }
            else if(strlen($nome) < 3){
                return "O nome deve possuir, no mínimo, 3 caracteres";
            }
            else{
                $this->nome = $nome;
                return "";
            }
        }
        else{
            return "Informe o nome do evento";
        }
    }

    public function setDescricao($descricao) {
        if(isset($descricao)){
            if(empty($descricao)){
                return "Informe uma descrição para o evento";
            }
            else{
                $this->descricao = $descricao;
                return "";
            }
        }
        else{
            return "Informe uma descrição para o evento";
        }
        
    }

    public function setLocal($local) {
        if(isset($local)){
            if(empty($local)){
                return "Informe o local do evento";
            }
            else{
                $this->local = $local;
                return "";
            }
        }
        else{
            return "Informe o local do evento";
        }
        
    }

    public function setLogoMarca($logoMarca) {
        $this->logoMarca = $logoMarca;
    }

    public function setNumVagas($numVagas) {
        if(isset($numVagas)){
            if(empty($numVagas)){
                $this->numVagas = 0;//PADRÃO É ZERO
            }
            else{
                $this->numVagas = $numVagas;
            }
        }
        else{
            $this->numVagas = 0;
        }
        
    }

    public function setInicioInscricao($inicioInscricao) {
        if(isset($inicioInscricao)){
            if(empty($inicioInscricao)){
                return "Informe a data de início das inscrições para o evento";
            }
            else if(strlen($inicioInscricao) != 10){//10/10/1212
                return "A data de início das inscrições deve possuir 10 caracteres ";
            }
            else{
                $this->inicioInscricao = $inicioInscricao;
                return "";
            }
        }
        else{
            return "Informe a data de início das inscrições para o evento";
        }
        
    }

    public function setFinalInscricao($finalInscricao) {
        if(isset($finalInscricao)){
            if(empty($finalInscricao)){
                return "Informe a data de término das inscrições para o evento";
            }
            else if(strlen($finalInscricao) != 10){//10/10/1212
                return "A data de término das inscrições deve possuir 10 caracteres ";
            }
            else{
                $this->finalInscricao = $finalInscricao;
                return "";
            }
        }
        else{
            return "Informe a data de término das inscrições para o evento";
        }        
    }

    public function setInicioSubmissao($inicioSubmissao) {
        if(isset($inicioSubmissao)){
            if(empty($inicioSubmissao)){
                $this->inicioSubmissao = '';
                return "";
            }
            else{
                if(strlen($inicioSubmissao) != 10){//10/10/1212
                    return "A data de início de submissão dos trabalhos deve possuir 10 caracteres ";
                }
                else{
                    $this->inicioSubmissao = $inicioSubmissao;
                    return "";
                }
            }
        }
        else{
            $this->inicioSubmissao = '';
            return "";
        }
    }

    public function setFinalSubmissao($finalSubmissao) {
        if(isset($finalSubmissao)){
            if(empty($finalSubmissao)){
                $this->finalSubmissao = '';
            }
            else{
                if(strlen($finalSubmissao) != 10){//10/10/1212
                    return "A data de término de submissão dos trabalhos deve possuir 10 caracteres ";
                }
                else{
                    $this->finalSubmissao = $finalSubmissao;
                }
            }
        }
        else{
            $this->finalSubmissao = '';
        }
        if($this->inicioSubmissao != '' && $this->finalSubmissao == ''){
            return "Ao definir uma data de início de submissões, é necessário definir uma data final";
        }
        else if($this->inicioSubmissao == '' && $this->finalSubmissao != ''){
            return "Ao definir uma data de final de submissões, é necessário definir uma data inicial";
        }
        else{
            return "";
        }
    }

    public function setInicioEvento($inicioEvento) {
        if(isset($inicioEvento)){
            if(empty($inicioEvento)){
                return "Informe a data de início do evento";
            }
            else if(strlen($inicioEvento) != 10){//10/10/1212
                return "A data de início do evento deve possuir 10 caracteres ";
            }
            else{
                $this->inicioEvento = $inicioEvento;
                return "";
            }
        }
        else{
            return "Informe a data de início do evento";
        }
        
    }

    public function setFinalEvento($finalEvento) {
        if(isset($finalEvento)){
            if(empty($finalEvento)){
                return "Informe a data de término do evento";
            }
            else if(strlen($finalEvento) != 10){//10/10/1212
                return "A data de término do evento deve possuir 10 caracteres ";
            }
            else{
                $this->finalEvento = $finalEvento;
                return "";
            }
        }
        else{
            return "Informe a data de término do evento";
        }        
    }

    public static function getTodosEventos(){
        $mensagem = array();
        $listaEventos = array();
        
        $dados = EventoDao::getEventos(0, '', '', '', '', '', '', _Util::getDataParaBd(date('d/m/Y')), '', 0);
        if($dados == null){
            return null;
        }
        else{
            try{
                while($obj = $dados->fetch_assoc()) {
                    $evento = new Evento();
                    
                    foreach ($obj as $key => $value) {
                        if($key == "inicioEvento" ||
                                $key == "finalEvento" ||
                                $key == "inicioSubmissao" ||
                                $key == "finalSubmissao" ||
                                $key == "inicioInscricao" ||
                                $key == "finalInscricao"){
                            $evento->{$key} = _Util::getDataDoBd($value);
                        }
                        else{
                            $evento->{$key} = $value;
                        }
                    }
                    
                    $listaEventos[] = $evento;
                }
            } catch (Exception $e) {
                $listaEventos = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $listaEventos;
        }
    }
    
    public static function getEventoPorId($pId, $pIdEventoPrincipal =0){
        $mensagem = array();
        
        $dados = EventoDao::getEventos($pId, '', '', '', '', '', '', '', '', $pIdEventoPrincipal);
        if($dados == null){
            return null;
        }
        else{
            try{
                while($obj = $dados->fetch_assoc()) {
                    $evento = new Evento();
                    
                    foreach ($obj as $key => $value) {
                        if($key == "inicioEvento" ||
                                $key == "finalEvento" ||
                                $key == "inicioSubmissao" ||
                                $key == "finalSubmissao" ||
                                $key == "inicioInscricao" ||
                                $key == "finalInscricao"){
                            $evento->{$key} = _Util::getDataDoBd($value);
                        }
                        else{
                            $evento->{$key} = $value;
                        }
                    }
                    return $evento;
                }
            } catch (Exception $e) {
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
    }
    
    public function getSubEventos(){
        $mensagem = array();
        $listaEventos = array();
        
        $dados = EventoDao::getEventos(0, '', '', '', '', '', '', _Util::getDataParaBd(date('d/m/Y')), '', $this->idEvento);
        if($dados == null){
            return null;
        }
        else{
            try{
                while($obj = $dados->fetch_assoc()) {
                    $evento = new Evento();
                    
                    foreach ($obj as $key => $value) {
                        if($key == "inicioEvento" ||
                                $key == "finalEvento" ||
                                $key == "inicioSubmissao" ||
                                $key == "finalSubmissao" ||
                                $key == "inicioInscricao" ||
                                $key == "finalInscricao"){
                            $evento->{$key} = _Util::getDataDoBd($value);
                        }
                        else{
                            $evento->{$key} = $value;
                        }
                    }
                    
                    $listaEventos[] = $evento;
                }
            } catch (Exception $e) {
                $listaEventos = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $listaEventos;
        }
    }
    
    public function salvar(){
        $mensagem = array();
        
        $dado = EventoDao::salvar($this->idEvento, $this->idEventoPrincipal, $this->nome, $this->descricao, 
                                  $this->local, $this->logoMarca, $this->numVagas,
                                  _Util::getDataParaBd($this->inicioInscricao), _Util::getDataParaBd($this->finalInscricao),
                                  _Util::getDataParaBd($this->inicioSubmissao), _Util::getDataParaBd($this->finalSubmissao),
                                  _Util::getDataParaBd($this->inicioEvento), _Util::getDataParaBd($this->finalEvento));
        
        if($dado == null){
            $mensagem[] = "Não foi possível cadastrar o evento";
        }
        else{
            try{
                while($obj = $dado->fetch_assoc()) {
                    return $obj["idEvento"];
                }
            }
            catch (Exception $e){
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
    }
    
    public static function excluirEvento($id){
        return EventoDao::excluirEvento($id);
    }
}
