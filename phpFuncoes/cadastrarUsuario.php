<?php
    require dirname(__FILE__).'/../phpClasses/Usuario.php';
    
    $mensagem = array();
    $titulo = "Atenção";
    //$mensagem = $_POST;
    if(isset($_POST) && !empty($_POST)){
        //VALIDAR CAMPOS
        extract($_POST);
        $usuario = new Usuario();
   
        $usuario->setId(0);
        
        $aux = $usuario->setCpf($pCpf);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
   
        $aux = $usuario->setNome($pNome);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
           
        $aux = $usuario->setEmail($pEmail);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
           
        $aux = $usuario->setSenha($pSenha, $pConfirmarSenha);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $usuario->setMatricula($pMatricula);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        if(isset($pAdministrador)){
            $aux = $usuario->setNivelAcesso($pAdministrador);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }
        }
        else{
            $usuario->setNivelAcesso(0);
        }
        
        if(isset($pAvaliador)){
            $aux = $usuario->setAvaliador($pAvaliador);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }
        }
        else {
            $usuario->setAvaliador(0);
        }
        
        $aux = $usuario->setImagem($_FILES["pImagem"]);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
    }
    else{
        $mensagem[] = "Formulário não enviado corretamente";
    }
    
    if(count($mensagem) > 0){
        echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
    }
    else{
        $aux = $usuario->salvar();
        if(!is_array($aux)){
            $usuario->setId($aux);
            
            if(strlen($usuario->getImagem()) > 0){
                if(!move_uploaded_file($_FILES["pImagem"]["tmp_name"], "../img/fotosUsuarios/".$usuario->getImagem())){
                    $mensagem[] = "Erro no envio da imagem";
                }
            }
            
            session_start();

            //SE JÁ ESTIVER LOGADO COMO ADMINISTRADOR
            if(isset($_SESSION["usuario"])){
                $administrador = $_SESSION["usuario"];
                if($administrador instanceof Usuario){
                    if($administrador->ehAdministrador()){
                        $mensagem[] = "Usuário: ".$usuario->getNome()." cadastrado com sucesso!";
                        echo json_encode(array("mensagem" => $mensagem, "titulo" => "Sucesso"));
                    }
                }
            }
            else{
                $_SESSION["usuario"] = $usuario;// ARMAZENA O OBJETO NA SESSÃO
                $_SESSION["mensagem"] = "Olá ".$usuario->getNome()."! Você foi cadastrado com sucesso!";
                echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
            }
        }
        else{
            echo json_encode(array("mensagem" => $aux, "titulo" => $titulo));
        }
    }
    