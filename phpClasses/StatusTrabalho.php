<?php

    require_once dirname(__FILE__).'/../phpDao/StatusTrabalhoDao.php';
class StatusTrabalho {

    private $idStatusTrabalho;
    private $descricao;

    public function getId(){
            return $this->idStatusTrabalho;
    }

    public function setId($id){
            $this->idStatusTrabalho = $id;
    }

    public function getDescricao(){
            return $this->descricao;
    }

    public function setDescricao($descricao){
            $this->descricao = $descricao;
    }

    public static function getTodosStatusTrabalho(){
        $mensagem = array();
        $listaStatusTrabalho = array();
        
        $dados = StatusTrabalhoDao::getStatusTrabalho(0, '');
        if($dados == null){
            $mensagem[] = "Nenhum status de inscricao encontrado!";
        }
        else{
            try{
                foreach ($dados as $obj){
                //while($obj = $dado->fetch_assoc()) {
                    $statusTrabalho = new StatusTrabalho();
                    
                    foreach ($obj as $key => $value) {
                        $statusTrabalho->{$key} = $value;
                    }
                    
                    $listaStatusTrabalho[] = $statusTrabalho;
                }
            } catch (Exception $e) {
                $listaStatusTrabalho = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $listaStatusTrabalho;
        }
    }
    
    public static function getStatusTrabalho($id, $statusTrabalho) {
        $mensagem = "";
        $status = null;
        
        $dado = StatusTrabalhoDao::getStatusTrabalho($id, $statusTrabalho);
        if($dado == null){
            $mensagem = "Status de trabalho desconhecido";
        }
        else{
            foreach ($dado as $obj){
                $status = new StatusTrabalho();
                foreach ($obj as $key => $value){
                    $status->{$key} = $value;
                }
            }
        }
        if($mensagem !== ''){
            return $mensagem;
        }
        else{
            return $status;
        }
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
