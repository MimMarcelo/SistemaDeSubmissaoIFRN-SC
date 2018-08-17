<?php
    require_once dirname(__FILE__).'/../phpDao/AreaAtuacaoDao.php';
/**
 * Description of AreaAtuacao
 *
 * @author Marcelo Júnior
 */
class AreaAtuacao {
    private $idAreaAtuacao;
    private $area;
    
    public function getIdAreaAtuacao() {
        return $this->idAreaAtuacao;
    }

    public function getAreaAtuacao() {
        return $this->area;
    }

    public function setIdAreaAtuacao($idAreaAtuacao) {
        $this->idAreaAtuacao = $idAreaAtuacao;
    }

    public function setAreaAtuacao($areaAtuacao) {
        $this->area = $areaAtuacao;
    }

    /**
     * Consulta todas as áreas de atuação registradas no banco de dados
     * @return AreaAtuacao[]
     */
    public static function getTodasAreasAtuacao(){
        $mensagem = array();
        $areasAtuacao = array();
        
        $dados = AreaAtuacaoDao::getAreaAtuacao(0, '');
        
        if($dados == null){//Caso não hajam dados
            $mensagem[] = "Nenhuma área de atuação encontrada!";
        }
        else{
            try{
                foreach ($dados as $obj){
                    $areaAtuacao = new AreaAtuacao();
                    
                    foreach ($obj as $key => $value) {
                        $areaAtuacao->{$key} = $value;
                    }
                    
                    $areasAtuacao[] = $areaAtuacao;
                }
            } catch (Exception $e) {
                $areasAtuacao = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $areasAtuacao;
        }
    }
    
    public static function getAreasPorIdUsuario($idUsuario){
        $areasAtuacao = array();
        
        $dados = AreaAtuacaoDao::getAreasPorIdUsuario($idUsuario);
        if($dados != null){
            try{
                foreach ($dados as $obj){
                //while($obj = $dado->fetch_assoc()) {
                    $areaAtuacao = new AreaAtuacao();
                    
                    foreach ($obj as $key => $value) {
                        $areaAtuacao->{$key} = $value;
                    }
                    
                    $areasAtuacao[] = $areaAtuacao;
                }
            } catch (Exception $e) {
                $areasAtuacao = null;
                $mensagem[] = $e->getMessage();
            }
        }
        return $areasAtuacao;
    }
}
