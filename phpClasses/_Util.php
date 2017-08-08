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
    
    public static function periodoValido($inicio, $fim){
        if($inicio > $fim){
            return false;
        }
        else{
            return true;
        }
    }
}
