<?php
    require dirname(__FILE__).'/../phpClasses/Usuario.php';
    
    function testaCampo($campo) {
        $campo = trim($campo);
        $campo = stripslashes($campo);
        $campo = htmlspecialchars($campo);
        return $campo;
    }
    
    $metodoHttp = $_SERVER['REQUEST_METHOD'];
    $mensagem = array();
    $titulo = "Atenção";
    
    if($metodoHttp == 'POST'){
        $cpf = "";
        $nome = "";
        $email = "";
        $senha = "";
        $matricula = "";
        $nomeImagem = "";
        $adm = 0;
        $avaliador = 0;
        
        //$json = json_decode(file_get_contents("php://input"));
        //print_r($_POST);
        //print_r($_FILES);
        //VALIDAR CAMPOS
        if(isset($_POST["pCpf"])){
            $cpf = testaCampo($_POST["pCpf"]);
        }
        else{
            $mensagem[] = "Informe o CPF";
        }
        
        if(isset($_POST["pNome"])){
            $nome = testaCampo($_POST["pNome"]);   
        }
        else{
            $mensagem[] = "Informe o nome de usuário";
        }
        
        if(isset($_POST["pEmail"])){
            $email = testaCampo($_POST["pEmail"]); 
        }
        else{
            $mensagem[] = "Informe o e-mail de usuário";
        }
        
        if(isset($_POST["pSenha"])){
            $senha = testaCampo($_POST["pSenha"]);
        }
        else{
            $mensagem[] = "Informe uma senha";
        }
        
        if(isset($_POST["pConfirmarSenha"])){
            $cSenha = testaCampo($_POST["pConfirmarSenha"]);
            if(empty($cSenha)){
                $mensagem[] = "Confirme sua senha";
            }
            else{
                if(strcmp($senha, $cSenha) != 0){
                    $mensagem[] = "As senhas não conferem";
                }
            }
        }
        else{
            $mensagem[] = "Confirme sua senha";
        }
        
        if(isset($_POST["pMatricula"])){
            $matricula = testaCampo($_POST["pMatricula"]);
        }
        
        if(isset($_POST["pAdministrador"])){
            if(!empty($_POST["pAdministrador"])){
                $adm = 1;
            }
        }
        
        if(isset($_POST["pAvaliador"])){
            if(!empty($_POST["pAvaliador"])){
                $avaliador = 1;
            }
        }
        
        $imagem = $_FILES["pImagem"];
        if(!empty($imagem["name"])){
            $tamanhoMaximoDoArquivo = 5242880;
            // Verifica se o arquivo é uma imagem
            if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $imagem["type"])){
                $mensagem[] = "Arquivo selecionado não é uma imagem.";
            }
            // Verifica se o tamanho da imagem é maior que o tamanho permitido
            if($imagem["size"] > $tamanhoMaximoDoArquivo) {
                $mensagem[] = "A imagem deve possuir, no máximo, 5 MB";
            }
            
            if(!count($mensagem) > 0){
                // Pega extensão da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);
                $nomeImagem = str_replace(".", "", $cpf);
                $nomeImagem = str_replace("-", "", $nomeImagem);
                $nomeImagem .= ".".$ext[1];
            }
        }
        
        if(count($mensagem) > 0){
            echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
        }
        else{

            $usuario = new Usuario();

            $usuario->setId(0);

            $aux = $usuario->setCpf($cpf);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }

            $aux = $usuario->setNome($nome);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }

            $aux = $usuario->setEmail($email);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }

            $aux = $usuario->setSenha($senha);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }

            $aux = $usuario->setMatricula($matricula);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }

            $aux = $usuario->setNivelAcesso($adm);
            if(strlen($aux) > 0){
                $mensagem[] = $aux;
            }

            $aux = $usuario->setAvaliador($avaliador);
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
                //print_r($aux);
                if(!is_array($aux)){
                    $usuario->setId($aux);
                    if(!move_uploaded_file($imagem["tmp_name"], "../img/fotosUsuarios/".$nomeImagem)){
                        $mensagem[] = "Erro no envio da imagem";
                    }
                    
                    //print_r($usuario);
                    session_start();

                    //SE JÁ ESTIVER LOGADO COMO ADMINISTRADOR
                    if(isset($_SESSION["usuario"])){
                        $administrador = $_SESSION["usuario"];
                        if($administrador instanceof Usuario){
                            if($administrador->ehAdministrador()){
                                $mensagem[] = "Usuário: '".$usuario->getNome()."' cadastrado com sucesso!";
                                echo json_encode(array("mensagem" => $mensagem, "titulo" => "Sucesso"));
                            }
                            else{
                                $_SESSION["usuario"] = $usuario;// ARMAZENA O OBJETO NA SESSÃO
                                $_SESSION["mensagem"] = "Usuário: '";$usuario->getNome()."' cadastrado com sucesso!";
                                echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
                            }
                        }
                    }
                    else{
                        $_SESSION["usuario"] = $usuario;// ARMAZENA O OBJETO NA SESSÃO
                        $_SESSION["mensagem"] = "Usuário: '";$usuario->getNome()."' cadastrado com sucesso!";
                        echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
                    }
                }
                else{
                    $mensagem = $aux;
                    echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
                }
            }
        }
    }
    else{
        $mensagem[] = "Método HTTP '".$metodoHttp."' ainda não implementado!";
        echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
    }
    
//        if(isset($pAdministrador)){
//            if(empty($pAdministrador)){
//                $pAdministrador = 0;
//            }
//        }
//        else{
//            $pAdministrador = 0;
//        }
//        
//        if(isset($pAvaliador)){
//            if(empty($pAvaliador)){
//                $pAvaliador = 0;
//            }
//            else{
//                $pAvaliador = 1;
//            }
//        }
//        else{
//            $pAvaliador = 0;
//        }
//        
//    }
//    else{
//        $mensagem[] = "Formulário não enviado corretamente";
//    }
//    
//    $foto = $_FILES["pImagem"];
//    $nomeImagem = "";
//    if(!empty($foto["name"])){
//        $tamanhoMaximoDoArquivo = 5242880;
//        // Verifica se o arquivo é uma imagem
//        if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
//            $mensagem[] = "Arquivo selecionado não é uma imagem.";
//        }
//        // Verifica se o tamanho da imagem é maior que o tamanho permitido
//        if($foto["size"] > $tamanho) {
//            $mensagem[] = "A imagem deve ter no máximo 5 MB";
//        }
//        if(!count($mensagem) > 0){
//            // Pega extensão da imagem
//            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
//            $nomeImagem = str_replace(".", "", $pCpf);
//            $nomeImagem = str_replace("-", "", $nomeImagem);
//            $nomeImagem .= ".".$ext[1];
//        }
//    }
//    
//    if(count($mensagem) > 0){
//        echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
//    }
//    else{
//        
//        $usuario = new Usuario();
//   
//        $usuario->setId(0);
//        
//        $aux = $usuario->setCpf($pCpf);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//   
//        $aux = $usuario->setNome($pNome);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//           
//        $aux = $usuario->setEmail($pEmail);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//           
//        $aux = $usuario->setSenha($pSenha);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//        
//        $aux = $usuario->setMatricula($pMatricula);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//           
//        $aux = $usuario->setNivelAcesso($pAdministrador);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//           
//        $aux = $usuario->setAvaliador($pAvaliador);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//        
//        $aux = $usuario->setImagem($nomeImagem);
//        if(strlen($aux) > 0){
//            $mensagem[] = $aux;
//        }
//        
//        if(count($mensagem) > 0){
//            echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
//        }
//        else{
//            $aux = $usuario->salvar();
//            if(!is_array($aux)){
//                $usuario->setId($aux);
//                if(!move_uploaded_file($foto["tmp_name"], "../img/fotosUsuarios/".$nomeImagem)){
//                    $mensagem[] = "Erro no envio da imagem";
//                }
//                session_start();
//                
//                //SE JÁ ESTIVER LOGADO COMO ADMINISTRADOR
//                if(isset($_SESSION["usuario"])){
//                    $administrador = $_SESSION["usuario"];
//                    if($administrador instanceof Usuario){
//                        if($administrador->ehAdministrador()){
////                            $_SESSION["mensagem"] = "Usuário: ";$usuario->getNome()." cadastrado com sucesso!";
////                            echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
//                            $mensagem[] = "Usuário: ".$usuario->getNome()." cadastrado com sucesso!";
//                            echo json_encode(array("mensagem" => $mensagem, "titulo" => "Sucesso"));
//                        }
//                    }
//                }
//                else{
//                    $_SESSION["usuario"] = $usuario;// ARMAZENA O OBJETO NA SESSÃO
//                    $_SESSION["mensagem"] = "Usuário: ";$usuario->getNome()." cadastrado com sucesso!";
//                    echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
//                }
//            }
//            else{
//                $mensagem[] = $aux;
//                echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
//            }
//        }
//    }
//    