<?php

require dirname(__FILE__).'/../phpClasses/Trabalho.php';
require dirname(__FILE__).'/validaUpload.php';

function testaCampo($campo) {
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

$metodoHttp = $_SERVER['REQUEST_METHOD'];
$mensagem = array();
$aux = "";
$tituloMensagem = "Atenção";

if($metodoHttp == 'POST'){
    
    //print_r($_POST);
    
    $localParaSalvar = dirname(__FILE__).'/../upload/trabalhos/';
    $tipoArquivo = "/(.pdf)/";
    
    $idEvento = 0;
    $instituicao = "";
    $titulo = "";
    $resumo = "";
    $palavrasChave = "";
    $nomeArquivo = "";
    $orientadores = array();
    $coAutores = array();
    $areasAtuacao = array();
    
    //VERIFICA SE OS CAMPOS FORAM PREENCHIDOS
    if(isset($_POST["pEvento"])){
        $idEvento = testaCampo($_POST["pEvento"]);
    }
    else{
        $mensagem[] = "Evento não identificado";
    }
    if(isset($_POST["pOrientador"])){
        foreach($_POST["pOrientador"] as $orientador){
            $orientador = testaCampo($orientador);
            if(is_numeric($orientador)){
                $orientadores[] = $orientador;
            }
        }
    }
    if(isset($_POST["pCoAutor"])){
        foreach($_POST["pCoAutor"] as $autor){
            $coAutores[] = testaCampo($autor);
        }
    }
    else{
        $mensagem[] = "Informe os autores do trabalho";
    }
    if(isset($_POST["pAreaAtuacao"])){
        foreach($_POST["pAreaAtuacao"] as $area){
            $areasAtuacao[] = testaCampo($area);
        }
    }
    else{
        $mensagem[] = "Informe a(s) área(s) de aplicação do trabalho";
    }
    if(isset($_POST["pInstituicao"])){
        $instituicao = testaCampo($_POST["pInstituicao"]);
    }
    else{
        $mensagem[] = "Informe a instituição de formento do trabalho";
    }
    if(isset($_POST["pTitulo"])){
        $titulo = testaCampo($_POST["pTitulo"]);
    }
    else{
        $mensagem[] = "Informe o título do trabalho";
    }
    if(isset($_POST["pResumo"])){
        $resumo = testaCampo($_POST["pResumo"]);
    }
    else{
        $mensagem[] = "Informe o resumo do trabalho";
    }
    if(isset($_POST["pPalavrasChave"])){
        $palavrasChave = testaCampo($_POST["pPalavrasChave"]);
    }
    else{
        $mensagem[] = "Informe as palavras-chave do trabalho";
    }
    
    $nomeArquivo = $idEvento."_".$coAutores[0]."_";
    $aux = validaUpload($_FILES["pArquivo"], true, $tipoArquivo, 2, $localParaSalvar, $nomeArquivo);
    if(strlen($aux) > 0){
        $mensagem[] = $aux;
    }
//    echo $idEvento."\n";
//    echo $instituicao. "\n";
//    echo $titulo. "\n";
//    echo $resumo. "\n";
//    echo $palavrasChave. "\n";
//    echo $nomeArquivo. "\n";
//    print_r($areasAtuacao);
//    print_r($orientadores);
//    print_r($coAutores);
//    exit();
//    
//    $this->idTrabalho,        (NÃO TEM PARA CADASTRO)
//    $this->idEvento,
//    $this->idStatusTrabalho,  (NÃO TEM PARA CADASTRO)
//    $this->instituicao,
//    $this->titulo,
//    $this->resumo, 
//    $this->palavrasChave, 
//    $this->arquivo, 
//    $areas, 
//    $orientadores, 
//    $autores
    if(count($mensagem) == 0){
        $trabalho = new Trabalho();
        
        $trabalho->setIdTrabalho(0);
        $trabalho->setIdEvento($idEvento);
        $trabalho->setIdStatusTrabalho(1);
        $trabalho->setArquivo($nomeArquivo);
        $trabalho->setPalavrasChave($palavrasChave);
        $trabalho->setOrientadores($orientadores);
        $trabalho->setCoAutores($coAutores);
        $trabalho->setAreasAplicacao($areasAtuacao);
        
        $aux = $trabalho->setTitulo($titulo);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        $aux = $trabalho->setResumo($resumo);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        if(count($mensagem) == 0){
            $aux = $trabalho->salvar();
            
            if(is_array($aux)){
                $trabalho->setIdTrabalho($aux);
                
                if(!move_uploaded_file($_FILES["pArquivo"]["tmp_name"], $localParaSalvar.$nomeArquivo)){
                    $mensagem[] = "Erro ao enviar o PDF do trabalho";
                }
                if(count($mensagem) == 0){
                    session_start();
                    $_SESSION["mensagem"] = "Trabalho: \'".$trabalho->getTitulo()."\' cadastrado com sucesso!";
                    echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
                    exit();
                }
            }
            else {
                $mensagem = $aux;
            }
        }
    }
    //print_r($_FILES["pArquivo"]);
    //print_r($mensagem);
}
echo json_encode(array("mensagem" => $mensagem, "titulo" => $tituloMensagem));