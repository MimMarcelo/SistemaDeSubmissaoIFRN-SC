<?php

function validaUpload($file, $obrigatorio, $tipoArquivo, $tamanhoMaximoEmMb, $localParaSalvar, &$nomeArquivo){
    $erro = "";
    if(empty($file["name"])){
        if($obrigatorio){
            $erro = "Arquivo não enviado";
        }
    }
    else{
        if($tipoArquivo != ""){
            $tipo = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            // Verifica o tipo do arquivo
            if(!strpos($tipoArquivo, $tipo)){
                $erro = "Arquivo selecionado não é do tipo esperado";
            }
        }
        
        if($erro == ""){
            if($tamanhoMaximoEmMb > 0){
                // Verifica se o tamanho da imagem é maior que o tamanho permitido
                $tamanhoMaximoDoArquivo = $tamanhoMaximoEmMb * 1024 * 1024;
                //echo "Máximo = $tamanhoMaximoDoArquivo\nArquivo = ".$file["size"];
                if($file["size"] > $tamanhoMaximoDoArquivo) {
                    return "O arquivo deve possuir no máximo $tamanhoMaximoEmMb Mb";
                }
            }
        }
        
        if($erro == ""){
            // Pega extensão do arquivo
            preg_match($tipoArquivo, $file["name"], $ext);
            $nomeArquivo = str_replace(".", "", $nomeArquivo);
            $nomeArquivo = str_replace("-", "", $nomeArquivo);
            $nomeArquivo = verificaSeJaExiste($localParaSalvar, $nomeArquivo, $tipo);
            
            //echo "$nomeArquivo";
            return "";
        }
    }
    $nomeArquivo = "";
    return $erro;
}

function verificaSeJaExiste($localParaSalvar, $nome, $extensao){
    $i = 0;
    while(file_exists($localParaSalvar.$nome.$i.".".$extensao)){
        $i++;
    }

    return $nome.$i.".".$extensao;
}