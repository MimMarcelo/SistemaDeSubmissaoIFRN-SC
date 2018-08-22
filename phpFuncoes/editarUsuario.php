<?php

session_start();
require dirname(__FILE__) . '/../phpClasses/Usuario.php';
require dirname(__FILE__) . '/validaUpload.php';
require dirname(__FILE__) . '/validaCampos.php';

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
} else {
    echo json_encode(array("redirecionar" => "index.php")); //REDIRECIONA
}

$metodoHttp = $_SERVER['REQUEST_METHOD'];
$mensagem = array();
$aux = "";
$titulo = "Atenção";

if ($metodoHttp == 'POST') {

    $senhaAtual = "";
    $nome = "";
    $email = "";
    $senha = "";
    $matricula = "";
    $adm = 0;
    $avaliador = 0;
    $areasAtuacao = array();

    //VERIFICA SE OS CAMPOS FORAM PREENCHIDOS
    if (isset($_POST["pSenhaAtual"])) {
        $senhaAtual = testaCampo($_POST["pSenhaAtual"]);
        $usuario->setSenha($senhaAtual);
        $u = Usuario::login($usuario->getCpf(), $usuario->getSenha());
        if ($u == null) {
            $mensagem[] = "A senha atual não confere";
        }
    } else {
        $mensagem[] = "Informe a senha atual";
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
    }

    if (isset($_POST["pMatricula"])) {
        $matricula = testaCampo($_POST["pMatricula"]);
    }

    if (isset($_POST["pAreaAtuacao"])) {
        $areasAtuacao = $_POST["pAreaAtuacao"];
        if ($usuario->getAvaliador() == 0) {
            $avaliador = 2; //INDICA QUE O USUÁRIO QUER SER AVALIADOR
        } else {
            $avaliador = $usuario->getAvaliador();
        }
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

    if (count($mensagem) == 0) {

        $aux = $usuario->setNome($nome);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $usuario->setEmail($email);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }
        
        if ($senha == "") {
            $usuario->clearSenha();
        }
        else{
            $aux = $usuario->setSenha($senha);
            if (strlen($aux) > 0) {
                $mensagem[] = $aux;
            }
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

        if (count($mensagem) == 0) {
            $aux = $usuario->atualizar();
            
            if (!is_array($aux)) {
                if (count($mensagem) == 0) {

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
            } else {
                $mensagem = $aux;
            }
        }
    }
}
echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
