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
        if($inicio > $fim){
            return false;
        }
        else{
            return true;
        }
    }
    
    public static function validaImagem($imagem){
        if(!empty($imagem["name"])){
            $tamanhoMaximoDoArquivo = 5242880;//5MB
            
            // Verifica se o arquivo é uma imagem
            if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $imagem["type"])){
                return "Arquivo selecionado não é uma imagem.";
            }
            
            // Verifica se o tamanho da imagem é maior que o tamanho permitido
            if($imagem["size"] > $tamanhoMaximoDoArquivo) {
                return "A imagem deve ter no máximo 5 MB";
            }
        }
    }
}
