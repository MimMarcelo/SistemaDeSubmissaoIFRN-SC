<?php

require dirname(__FILE__) . '/../phpClasses/Evento.php';
require dirname(__FILE__) . '/validaUpload.php';
require dirname(__FILE__) . '/validaCampos.php';

$metodoHttp = $_SERVER['REQUEST_METHOD'];
$mensagem = array();
$aux = "";
$titulo = "Atenção";

if ($metodoHttp == 'POST') {
    $localParaSalvar = dirname(__FILE__) . '/../upload/eventos/';
    $tipoArquivo = "/(.jpg)(.jpeg)(.gif)(.png)/";

    $idEventoPrincipal = 0;
    $nome = "";
    $descricao = "";
    $local = "";
    $nVagas = 0;
    $nomeArquivo = "";
    $inicioEvento = "";
    $fimEvento = "";
    $inicioInscricoes = "";
    $fimInscricoes = "";
    $inicioSubmissoes = "";
    $fimSubmissoes = "";

    if (isset($_POST["pEventoPrincipal"])) {
        $idEventoPrincipal = testaCampo($_POST["pEventoPrincipal"]);
    } else {
        $mensagem[] = "Não foi possível identificar se o evento é principal ou não!";
    }

    if (isset($_POST["pNome"])) {
        $nome = testaCampo($_POST["pNome"]);
    } else {
        $mensagem[] = "Informe o nome do evento!";
    }

    if (isset($_POST["pDescricao"])) {
        $descricao = testaCampo($_POST["pDescricao"]);
    } else {
        $mensagem[] = "Informe uma descrição para o evento!";
    }

    if (isset($_POST["pLocal"])) {
        $local = testaCampo($_POST["pLocal"]);
    } else {
        $mensagem[] = "Informe o local do evento!";
    }

    if (isset($_POST["pNumeroVagas"])) {
        $nVagas = testaCampo($_POST["pNumeroVagas"]);
    } else {
        $mensagem[] = "Informe o número de vagas do evento!";
    }

    if (isset($_POST["pDataInicioEvento"])) {
        $inicioEvento = testaCampo($_POST["pDataInicioEvento"]);
    } else {
        $mensagem[] = "Informe a data de início de realização do evento!";
    }

    if (isset($_POST["pDataFimEvento"])) {
        $fimEvento = testaCampo($_POST["pDataFimEvento"]);
    } else {
        $mensagem[] = "Informe a data de término de realização do evento!";
    }

    if (isset($_POST["pDataInicioInscricao"])) {
        $inicioInscricoes = testaCampo($_POST["pDataInicioInscricao"]);
    } else {
        $mensagem[] = "Informe a data de início das inscrições para o evento!";
    }

    if (isset($_POST["pDataFimInscricao"])) {
        $fimInscricoes = testaCampo($_POST["pDataFimInscricao"]);
    } else {
        $mensagem[] = "Informe a data de término das inscrições para o evento!";
    }

    if (isset($_POST["pDataInicioTrabalho"])) {
        $inicioSubmissoes = testaCampo($_POST["pDataInicioTrabalho"]);
    }

    if (isset($_POST["pDataFimTrabalho"])) {
        $fimSubmissoes = testaCampo($_POST["pDataFimTrabalho"]);
    }

    if (!_Util::periodoValido($inicioEvento, $fimEvento)) {
        $mensagem[] = "A data de término do evento deve ser maior ou igual a data de início";
    }

    if (!_Util::periodoValido($inicioInscricoes, $fimInscricoes)) {
        $mensagem[] = "A data de término das inscrições deve ser maior ou igual a data de início";
    }

    if ($inicioSubmissoes != '') {
        if (!_Util::periodoValido($inicioSubmissoes, $fimSubmissoes)) {
            $mensagem[] = "A data de término de submissão dos trabalhos deve ser maior ou igual a data de início";
        }
    }

    if (isset($_FILES["pImagem"])) {
        $nomeArquivo = "evento_";
        $aux = validaUpload($_FILES["pImagem"], FALSE, $tipoArquivo, 4, $localParaSalvar, $nomeArquivo);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }
    }
    if (count($mensagem) == 0) {
        $evento = new Evento();

        $evento->setIdEvento(0);
        $evento->setIdEventoPrincipal($idEventoPrincipal);

        $aux = $evento->setNome($nome);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setDescricao($descricao);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setLocal($local);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setNumVagas($nVagas);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setLogoMarca($nomeArquivo);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setInicioEvento($inicioEvento);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setFinalEvento($fimEvento);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setInicioInscricao($inicioInscricoes);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }

        $aux = $evento->setFinalInscricao($fimInscricoes);
        if (strlen($aux) > 0) {
            $mensagem[] = $aux;
        }
        $evento->setInicioSubmissao($inicioSubmissoes);
        $evento->setFinalSubmissao($fimSubmissoes);

        if (count($mensagem) == 0) {
            $aux = $evento->salvar();
            if (!is_array($aux)) {
                session_start();
                $evento->setIdEvento($aux);
                if ($nomeArquivo !== "") {
                    if (!move_uploaded_file($_FILES["pImagem"]["tmp_name"], $localParaSalvar . $nomeArquivo)) {
                        $mensagem[] = "Erro ao enviar a imagem";
                    }
                }
                $_SESSION["mensagem"] = "Evento: \'" . $evento->getNome() . "\' cadastrado com sucesso!";
                echo json_encode(array("redirecionar" => "cadastrarEvento.php")); //REDIRECIONA PARA A PÁGINA DE INÍCIO
                exit();
            } else {
                $mensagem[] = $aux;
            }
        }
    }
} else {
    $mensagem[] = "Formulário não enviado corretamente";
}
echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
