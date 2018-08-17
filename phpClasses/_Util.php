<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of _Util
 *
 * @author Marcelo Júnior
 */
class _Util {
    
    public static function getDataParaBd($data) {
        if($data == ''){
            return $data;
        }
        else{
            return date('Y-m-d', strtotime(str_replace('/', '-', $data)));
        }
    }
    
    public static function getDataDoBd($data) {
        if($data == ''){
            return $data;
        }
        else{
            return date('d/m/Y', strtotime($data));
        }
    }
    
    public static function periodoValido($inicio, $fim){
//        echo "\n$inicio, "._Util::getDataParaBd($inicio);
//        echo "\n$fim, "._Util::getDataParaBd($fim);
//        echo "\n".($inicio>$fim);
//        echo "\n".(_Util::getDataParaBd($inicio)>_Util::getDataParaBd($fim));
        if(_Util::getDataParaBd($inicio)>=_Util::getDataParaBd($fim)){
            return false;
        }
        else{
            return true;
        }
    }
    
    public static function getObject($objeto, $dados){
        foreach ($dados as $key => $value) {
            $objeto->{$key} = $value;
        }
        return $objeto;
    }
}
