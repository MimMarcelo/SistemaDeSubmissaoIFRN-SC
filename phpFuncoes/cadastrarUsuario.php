<?php
    require dirname(__FILE__).'/../phpClasses/Usuario.php';
    
    $mensagem = array();
    $titulo = "Atenção";
    //$mensagem = $_POST;
    if(isset($_POST) && !empty($_POST)){
        //VALIDAR CAMPOS
        extract($_POST);
        
        if(isset($pCpf)){
            if(empty($pCpf)){
                $mensagem[] = "Informe o CPF";
            }
            else if(strlen($pCpf) != 14){
                $mensagem[] = "O CPF deve possuir 11 caracteres ";
            }
        }
        else{
            $mensagem[] = "Informe o CPF";
        }
        
        if(isset($pNome)){
            if(empty($pNome)){
                $mensagem[] = "Informe o Nome";
            }
            else if(strlen($pNome) < 3){
                $mensagem[] = "O nome deve possuir, no mínimo, 3 caracteres";
            }
        }
        else{
            $mensagem[] = "Informe o Nome";
        }
        
        if(isset($pEmail)){
            if(empty($pEmail)){
                $mensagem[] = "Informe o e-mail";
            }
        }
        else{
            $mensagem[] = "Informe o e-mail";
        }
        
        if(isset($pSenha)){
            if(empty($pSenha)){
                $mensagem[] = "Informe uma senha";
            }
            else if(strlen($pSenha) < 3){
                $mensagem[] = "A senha deve possuir, no mínimo, 3 caracteres: ";
            }
        }
        else{
            $mensagem[] = "Informe uma senha";
        }
        
        if(isset($pConfirmarSenha)){
            if(empty($pConfirmarSenha)){
                $mensagem[] = "Confirme sua senha";
            }
            else{
                if(strcmp($pSenha, $pConfirmarSenha) != 0){
                    $mensagem[] = "As senhas não conferem";
                }
            }
        }
        else{
            $mensagem[] = "Confirme sua senha";
        }
        
        if(isset($pMatricula)){
            if(empty($pMatricula)){
                $pMatricula = "";
            }
        }
        else{
            $pMatricula = "";
        }
        
        if(isset($pNivelAcesso)){
            if(empty($pNivelAcesso)){
                $pNivelAcesso = 1;
            }
        }
        else{
            $pNivelAcesso = 1;
        }
        
        if(isset($pStatusInscricao)){
            if(empty($pStatusInscricao)){
                $pStatusInscricao = 1;
            }
        }
        else{
            $pStatusInscricao = 1;
        }
        
        if(isset($pAvaliador)){
            if(empty($pAvaliador)){
                $pAvaliador = 0;
            }
            else{
                $pAvaliador = 1;
            }
        }
        else{
            $pAvaliador = 0;
        }
        
    }
    else{
        $mensagem[] = "Formulário não enviado corretamente";
    }
    
    if(count($mensagem) > 0){
        echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
    }
    else{
        
        $foto = $_FILES["pImagem"];
        $nomeImagem = "";
        if(empty($foto["name"])){
            $tamanhoMaximoDoArquivo = 5242880;
            // Verifica se o arquivo é uma imagem
            if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                $mensagem[] = "Arquivo selecionado não é uma imagem.";
            }
            // Verifica se o tamanho da imagem é maior que o tamanho permitido
            if($foto["size"] > $tamanho) {
                $mensagem[] = "A imagem deve ter no máximo 5 MB";
            }
            
        }
        if(!count($mensagem) > 0){
            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
            $nomeImagem = str_replace(".", "", $pCpf);
            $nomeImagem = str_replace("-", "", $nomeImagem);
            $nomeImagem .= ".".$ext[1];
        }
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
           
        $aux = $usuario->setSenha($pSenha);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $usuario->setMatricula($pMatricula);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
           
        $aux = $usuario->setNivelAcesso($pNivelAcesso);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
           
        $aux = $usuario->setStatusInscricao($pStatusInscricao);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
           
        $aux = $usuario->setAvaliador($pAvaliador);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        $aux = $usuario->setImagem($nomeImagem);
        if(strlen($aux) > 0){
            $mensagem[] = $aux;
        }
        
        if(count($mensagem) > 0){
            echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
        }
        else{
            $aux = $usuario->salvar();
            if(!is_array($aux)){
                $usuario->setId($aux);
                move_uploaded_file($foto["tmp_name"], "../img/fotosUsuarios/".$nomeImagem);
                
                session_start();
                
                //SE JÁ ESTIVER LOGADO COMO ADMINISTRADOR
                $administrador = $_SESSION["usuario"];
                if(isset($administrador)){
                    if($administrador instanceof Usuario){
                        if($administrador->ehAdministrador()){
//                            $_SESSION["mensagem"] = "Usuário: ";$usuario->getNome()." cadastrado com sucesso!";
//                            echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
                             $mensagem[] = "Usuário: ".$usuario->getNome()." cadastrado com sucesso!";
                            echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
                            exit();
                        }
                    }
                }
                
                $_SESSION["usuario"] = $usuario;// ARMAZENA O OBJETO NA SESSÃO
                $_SESSION["mensagem"] = "Usuário: ";$usuario->getNome()." cadastrado com sucesso!";
                echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
            }
            else{
                $mensagem[] = $aux;
                echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
            }
        }
    }
    