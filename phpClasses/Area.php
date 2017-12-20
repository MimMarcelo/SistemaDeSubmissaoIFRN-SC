<?php

    require_once dirname(__FILE__).'/../phpDao/AreaDao.php';

class Area{
    private $idArea;
    private $area;
    
    public function getIdArea() {
        return $this->idArea;
    }

    public function getArea() {
        return $this->area;
    }

    public static function consultarAreas($id, $area){
        $mensagem = array();
        $areas = array();
        
        $dados = AreaDao::consultarAreas($id, $area);
        if($dados == null){
            $mensagem[] = "Nenhuma área encontrada!";
        }
        else{
            try{
                while($obj = $dados->fetch_assoc()) {
                    $area = new Area();
                    
                    foreach ($obj as $key => $value) {
                        $area->{$key} = $value;
                    }
                    
                    $areas[] = $area;
                }
            } catch (Exception $e) {
                $areas = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $areas;
        }
    }
}