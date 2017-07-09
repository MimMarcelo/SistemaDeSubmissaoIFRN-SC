<?php
    $mensagem = array();
    $mensagem[] = "Arquivo enviado";
    $titulo = "Sucesso!";
    if(isset($_FILES)){
        //$arquivo = $_FILES['teste'];
        print_r($_FILES);
        //print_r($arquivo);
    }
    else{
        $titulo = "Atenção!";
        $mensagem[] = "Nenhum arquivo recebido";
        echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
    }
    if(isset($_POST)){
        echo "<br>";
        print_r($_POST);
    }
    
