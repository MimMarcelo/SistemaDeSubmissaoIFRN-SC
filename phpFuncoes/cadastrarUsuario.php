<?php

require dirname(__FILE__) . '/../phpClasses/Usuario.php';
require dirname(__FILE__) . '/validaUpload.php';
require dirname(__FILE__) . '/validaCampos.php';

$metodoHttp = $_SERVER['REQUEST_METHOD'];
$mensagem = array();
$aux = "";
$titulo = "Atenção";

if ($metodoHttp == 'POST') {

//    print_r($_POST);
//    exit();
    $localParaSalvar = dirname(__FILE__) . '/../upload/usuarios/';
    $tipoArquivo = "/(.jpg)(.jpeg)(.gif)(.png)/";

    $cpf = "";
    $nome = "";
    $email = "";
    $senha = "";
    $matricula = "";
    $nomeArquivo = "";
    $adm = 0;
    $avaliador = 0;
    $areasAtuacao = array();

    //VERIFICA SE OS CAMPOS FORAM PREENCHIDOS
    if (isset($_POST["pCpf"])) {
        $cpf = testaCampo($_POST["pCpf"]);
    } else {
        $mensagem[] = "Informe o CPF";
    }

    if (isset($_POST["pNome"])) {
        $nome = testaCampo($_POST["pNome"]);
    } else {
        $mensagem[] = "Informe o nome de usuário";
    }

    if (isset($_POST["pEmail"])) {
        $email = testaCampo($_POST["pEmail"]);
    } else {
        $mensagem[] = "Informe o e-mail de usuário";
    }

    if (isset($_POST["pSenha"])) {
        $senha = testaCampo($_POST["pSenha"]);
    } else {
        $mensagem[] = "Informe uma senha";
    }

    if (isset($_POST["pConfirmarSenha"])) {
        $cSenha = testaCampo($_POST["pConfirmarSenha"]);
        if (empty($cSenha)) {
            $mensagem[] = "Confirme sua senha";
        } else {
            if (strcmp($senha, $cSenha) != 0) {
                $mensagem[] = "As senhas não conferem";
            }
        }
    } else {
        $mensagem[] = "Confirme sua senha";
    }

    if (isset($_POST["pMatricula"])) {
        $matricula = testaCampo($_POST["pMatricula"]);
    }

    if (isset($_POST["pAreaAtuacao"])) {
        $areasAtuacao = $_POST["pAreaAtuacao"];
        $avaliador = 2;//INDICA QUE O USUÁRIO QUER SER AVALIADOR
    }

    if (isset($_POST["pAdministrador"])) {
        if (!empty($_POST["pAdministrador"])) {
            $adm = 1;
        }
    }

    if (isset($_POST["pAvaliador"])) {
        if (!empty($_POST["pAvaliador"])) {
            $avaliador = 1;
        }
    }
    
    if(isset($_FILES["pImagem"])){
        $nomeArquivo = str_replace(".", "", $cpf);
        $nomeArquivo = str_replace("-", "", $nomeArquivo);
        $nomeArquivo = $nomeArquivo . "_";
        $aux = validaUpload($_FILES["pImagem"], FALSE, $tipoArquivo, 4, $localParaSalvar, $nomeArquivo);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }
    }
    if (count($mensagem) == 0) {
        $usuario = new Usuario();

        $usuario->setId(0);

        $aux = $usuario->setCpf($cpf);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setNome($nome);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setEmail($email);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setSenha($senha);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setMatricula($matricula);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setAreasAtuacao($areasAtuacao);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setNivelAcesso($adm);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setAvaliador($avaliador);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setImagem($nomeArquivo);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        if (count($mensagem) == 0) {
            $aux = $usuario->salvar();
            //print_r($aux);
            if (!is_array($aux)) {
                $usuario->setId($aux);

                if($nomeArquivo !== ""){
                    if (!move_uploaded_file($_FILES["pImagem"]["tmp_name"], $localParaSalvar . $nomeArquivo)) {
                        $mensagem[] = "Erro ao enviar a imagem";
                    }
                }
                if (count($mensagem) == 0) {
                    session_start();

                    //SE JÁ ESTIVER LOGADO COMO ADMINISTRADOR
                    if (isset($_SESSION["usuario"])) {
                        $administrador = $_SESSION["usuario"];
                        if ($administrador instanceof Usuario) {
                            if (!$administrador->ehAdministrador()) {
                                $_SESSION["usuario"] = $usuario; // ARMAZENA O OBJETO NA SESSÃO
                            }
                            $_SESSION["mensagem"] = "Usuário: \'" . $usuario->getNome() . "\' cadastrado com sucesso!";
                            echo json_encode(array("redirecionar" => "inicio.php")); //REDIRECIONA PARA A PÁGINA DE INÍCIO
                        }
                    } else {
                        $_SESSION["usuario"] = $usuario; // ARMAZENA O OBJETO NA SESSÃO
                        $_SESSION["mensagem"] = "Usuário: \'" . $usuario->getNome() . "\' cadastrado com sucesso!";
                        echo json_encode(array("redirecionar" => "inicio.php")); //REDIRECIONA PARA A PÁGINA DE INÍCIO
                    }
                    exit();
                }
            }
            else{
                $mensagem = $aux;
            }
        }
    }
}
echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
