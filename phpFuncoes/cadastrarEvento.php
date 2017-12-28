<?php
    require dirname(__FILE__).'/../phpClasses/Evento.php';
    
    $mensagem = array();
    $titulo = "Atenção";

    if(isset($_POST) && !empty($_POST)){
        //VALIDAR CAMPOS
        extract($_POST);
        $evento = new Evento();
        
        $evento->setIdEvento(0);
        $evento->setIdEventoPrincipal($pEventoPrincipal);
        
        $aux = $evento->setNome($pNome);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $evento->setDescricao($pDescricao);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $evento->setLocal($pLocal);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $evento->setNumVagas($pNumeroVagas);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $evento->setInicioEvento($pDataInicioEvento);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $evento->setFinalEvento($pDataFimEvento);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $evento->setInicioInscricao($pDataInicioInscricao);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $evento->setFinalInscricao($pDataFimInscricao);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        $evento->setInicioSubmissao($pDataInicioTrabalho);
        $evento->setFinalSubmissao($pDataFimTrabalho);
        
        if(!_Util::periodoValido($evento->getInicioEvento(), $evento->getFinalEvento())){
            $mensagem[] = "A data de término do evento deve ser maior ou igual a data de início";
        }
        
        if(!_Util::periodoValido($evento->getInicioInscricao(), $evento->getFinalInscricao())){
            $mensagem[] = "A data de término das inscrições deve ser maior ou igual a data de início";
        }
        
        if($evento->getInicioSubmissao() != ''){
            if(!_Util::periodoValido($evento->getInicioSubmissao(), $evento->getFinalSubmissao())){
                $mensagem[] = "A data de término de submissão dos trabalhos deve ser maior ou igual a data de início";
            }
        }
        if(count($mensagem) > 0){
            echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
        }
        else{
            $foto = $_FILES["pImagem"];
            $nomeImagem = "";
            if(!empty($foto["name"])){
                $tamanhoMaximoDoArquivo = 5242880;
                // Verifica se o arquivo é uma imagem
                if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                    $mensagem[] = "Arquivo selecionado não é uma imagem.";
                }
                // Verifica se o tamanho da imagem é maior que o tamanho permitido
                if($foto["size"] > $tamanhoMaximoDoArquivo) {
                    $mensagem[] = "A imagem deve ter no máximo 5 MB";
                }
                if(!count($mensagem) > 0){
                    // Pega extensão da imagem
                    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
                    $nomeImagem = str_replace(" ", "_", $pNome);

                    $idImagem = 1;
                    while(file_exists("../img/fotosEventos/".$nomeImagem.$idImagem.".".$ext[1])){
                        $idImagem++;
                    }
                    $nomeImagem .= $idImagem.".".$ext[1];
                }
            }
            
            $evento->setLogoMarca($nomeImagem);
            $aux = $evento->salvar();
            if(!is_array($aux)){
                $evento->setIdEvento($aux);
                if(!empty($nomeImagem)){
                    if(!move_uploaded_file($foto["tmp_name"], "../img/fotosEventos/".$nomeImagem)){
                        $mensagem[] = "Erro no envio da imagem";
                    }
                }
                $mensagem[] = "Evento cadastrado com sucesso";
            }
            else{
                $mensagem[] = $aux;
            }
            echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
        }        
    }
    else{
        $mensagem[] = "Formulário não enviado corretamente";
    }
    
    