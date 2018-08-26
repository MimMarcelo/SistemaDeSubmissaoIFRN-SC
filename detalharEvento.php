<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Detalhar Evento</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/phpClasses/Evento.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio(); //LOGIN OBRIGATÓRIO
        ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php //include './includes/menu.php'; ?>

        <div id="carregaPagina">
            <section id="conteudo">
                <?php
                $evento = new Evento();
                if (isset($_SESSION["evento"])) {
                    if (!empty($_SESSION["evento"])) {
                        $evento = $_SESSION["evento"];
                        //unset($_SESSION["evento"]);
                    } else {
                        $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                        header("location: listarEventos.php");
                    }
                } else {
                    $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                    header("location: listarEventos.php");
                }
                ?>
                <div id="atualizavel">
                    <article class="evento">
                        <h2><?= $evento->getNome() ?></h2>
                        <h3>
                            <?= "de " . $evento->getInicioEvento() . " à " . $evento->getFinalEvento() ?>
                        </h3>
                        <div>
                            <img src="upload/eventos/<?= $evento->getLogoMarca()->getArquivo(); ?>" alt="<?= $evento->getLogoMarca()->getDescricao() ?>">
                        </div>
                        <div>
                            <h4>Descrição</h4>
                            <p>
                                <?= $evento->getDescricao() ?>
                            </p>
                            <div class="tag">
                                <div class="aEsquerda">
                                    <img src="img/logo250.png" alt="ícone">
                                </div>
                                <ul>
                                    <li>
                                        <span>Local: </span>
                                        <a href='https://www.google.com.br/maps/place/<?= $evento->getLocal(); ?>' target='_blank'><?= $evento->getLocal(); ?></a>
                                    </li>
                                    <li>
                                        <span>Número de vagas: </span>
                                        <?php
                                        $vagas = $evento->getNumVagas();
                                        if ($vagas < 1) {
                                            echo "Ilimitado";
                                        } else {
                                            echo "$vagas";
                                        }
                                        ?>
                                    </li>                                    
                                    <li>
                                        <span>Inscrições: </span>
                                        de <?= $evento->getInicioInscricao() ?>
                                        a <?= $evento->getFinalInscricao() ?>

                                        <?php
//CRIA OBJETO COM INFORMAÇÕES DA RELAÇÃO DO USUÁRIO COM O EVENTO
                                        $usuarioEvento = $usuario->getEvento($evento->getIdEvento());

                                        $hoje = date("Y-m-d");
//VERIFICA SE PODE SE INSCREVER
                                        $podeSeInscrever = TRUE;
                                        $statusInscricao = "Inscreva-se";
//print_r($usuarioEvento);
                                        if (($usuarioEvento) instanceof UsuarioEvento) {
                                            $podeSeInscrever = FALSE; //JÁ ESTÁ INSCRITO
                                            $statusInscricao = $usuarioEvento->getStatusInscricao()->getStatusInscricao();
                                        } else if (_Util::periodoValido($evento->getFinalInscricao(), date('Y-m-d', strtotime($hoje . ' - 1 days')))) {
                                            $podeSeInscrever = FALSE; //INSCRIÇÕES ENCERRADAS 
                                            $statusInscricao = "Inscrições encerradas";
                                        } else if (_Util::periodoValido(date('Y-m-d', strtotime($hoje . ' + 1 days')), $evento->getInicioInscricao())) {
                                            $podeSeInscrever = FALSE; //INSCRIÇÕES AINDA NÃO ABERTAS 
                                            $statusInscricao = "Inscrições a partir de " . $evento->getInicioInscricao();
                                        }

                                        if ($statusInscricao == "Inscreva-se") {
                                            ?>
                                        <button class="botao"
                                                onclick='confirmarTermosDeUso("upload/eventos/<?= $evento->getTermosDeUso()->getArquivo(); ?>",
                                                                "phpFuncoes/inscreverEmEvento.php",
                                                "<?= $evento->getIdEvento(); ?>",
                                                "<?= $evento->getNome(); ?>");'>
                                                Confirmar inscrição
                                            </button>
                                            <?php
                                        } else {
                                            echo "<br>Status da Inscrição: $statusInscricao";
                                        }
                                        ?>
                                    </li>
                                    <?php
                                    //VERIFICAÇÃO SE ACEITA SUBMISSÃO DE TRABALHOS
                                    if ($evento->getInicioSubmissao() != "") {
                                        ?>
                                        <li>
                                            <span>Submissão de trabalhos: </span>
                                            de <?php echo $evento->getInicioSubmissao() ?>
                                            a <?php echo $evento->getFinalSubmissao() ?>
                                            <?php
                                            $podeSubmeter = TRUE;
                                            if (_Util::periodoValido($evento->getFinalSubmissao(), $hoje)) {
                                                $podeSubmeter = FALSE; //INSCRIÇÕES ENCERRADAS 
                                                $statusInscricao = "Submissões encerradas";
                                            } else if (_Util::periodoValido($hoje, $evento->getInicioSubmissao())) {
                                                $podeSubmeter = FALSE; //INSCRIÇÕES AINDA NÃO ABERTAS 
                                                $statusInscricao = "Submissões a partir de " . $evento->getInicioSubmissao();
                                            } else if (!($usuarioEvento) instanceof UsuarioEvento) {
                                                $podeSubmeter = FALSE; //INSCRIÇÕES AINDA NÃO ABERTAS 
                                                $statusInscricao = "Inscreva-se para poder submeter trabalhos!";
                                            }
                                            if ($podeSubmeter) {
                                                ?>
                                                <form action="phpFuncoes/submeterTrabalho.php" method="post">
                                                    <input type="hidden" name="pIdEvento" value="<?= $evento->getIdEvento(); ?>">
                                                    <input type="hidden" name="pEvento" value="<?= $evento->getNome(); ?>">
                                                    <input type="submit" value="Submeta trabalhos" class="botao">
                                                </form>
                                                <?php
                                            } else {
                                                echo "<br>$statusInscricao";
                                            }
                                            ?>
                                        </li>
                                        <?php
                                    }//FIM DA VERIFICAÇÃO SE ACEITA SUBMISSÃO DE TRABALHOS
                                    ?>
                                    <li>
                                        <a class="inscrevase" href="upload/eventos/<?= $evento->getTermosDeUso()->getArquivo(); ?>" target="_blank"><?= $evento->getTermosDeUso()->getDescricao(); ?></a>
                                        <?php
                                        if (count($evento->getModelos()) > 0) {
                                            foreach ($evento->getModelos() as $modelo) {
                                                echo '<a class="inscrevase" href="upload/eventos/' . $modelo->getArquivo() . '" target="_blank">' . $modelo->getDescricao() . '</a>';
                                            }
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <?php if ($usuario->ehAdministrador()) { ?>
                                <span>Consultar: </span>
                                <a href="credenciar.php">Lista de Inscritos</a>
                            <?php }// FECHA IF ADMINISTRADOR ?>
                            <?php
                            $subEventos = $evento->getSubEventos();

                            if (is_array($subEventos) && count($subEventos) > 0) {
                                ?>
                                <h4>Eventos internos</h4>
                                <table id="idTabela">
                                    <thead>
                                    <th onclick="ordenarTabela('idTabela', 0)">
                                        Dias
                                    </th>
                                    <th onclick="ordenarTabela('idTabela', 1)">
                                        Evento
                                    </th>
                                    <th>
                                        Local
                                    </th>
                                    <th>
                                        Ações
                                    </th>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($subEventos as $s) {
                                            //VERIFICA SE AS INSCRIÇÕES PARA O EVENTO JÁ ESTÃO ENCERRADAS
                                            $inscricaoEncerrada = FALSE;
                                            if (_Util::periodoValido($s->getFinalInscricao(), $hoje)) {
                                                $inscricaoEncerrada = TRUE;
                                            }

                                            //CRIA OBJETO COM INFORMAÇÕES DA RELAÇÃO DO USUÁRIO COM O EVENTO
                                            $usuarioEvento = $usuario->getEvento($s->getIdEvento());

                                            $statusInscricao = "Inscreva-se";
                                            if (($usuarioEvento) instanceof UsuarioEvento) {
                                                $statusInscricao = $usuarioEvento->getStatusInscricao()->getStatusInscricao();
                                            } else if ($inscricaoEncerrada) {
                                                $statusInscricao = "Inscrições encerradas";
                                            } else if (_Util::periodoValido($hoje, $s->getInicioInscricao())) {
                                                $statusInscricao = "A partir de " . $s->getInicioInscricao();
                                            }
                                            ?>

                                            <tr>
                                                <td class="centralizado">
                                                    <?= $s->getInicioEvento(); ?><br>-<br><?= $s->getFinalEvento(); ?>
                                                </td>
                                                <td>
                                                    <?= $s->getNome(); ?>
                                                </td>
                                                <td class="centralizado">
                                                    <?= $s->getLocal(); ?>
                                                </td>
                                                <td class="centralizado">

                                                    <?php if ($usuario->ehAdministrador()) { ?>
                                                        <span>
                                                            <img src="img/iconFechar.png" class="fechar" title="Excluir evento <?= $s->getNome(); ?>"
                                                                 onclick='abrePopupConfirm("Confirma a exclusão do evento \"<?= $s->getNome(); ?>\"?",
                                                                                             "phpFuncoes/excluirEvento.php",
                                                                                             "<?= $s->getIdEvento(); ?>",
                                                                                             "<?= $s->getNome(); ?>")'>
                                                        </span>
                                                    <?php }// FECHA IF ADMINISTRADOR  ?>
                                                    <form action="phpFuncoes/detalharEvento.php" method="post">
                                                        <input type="hidden" value="<?= $s->getIdEvento(); ?>" name="pId">
                                                        <input type="hidden" value="<?= $s->getIdEventoPrincipal(); ?>" name="pIdPrincipal">
                                                        <input type="submit" class="botao menosPadding" value="<?php echo ($statusInscricao == "Inscreva-se") ? $statusInscricao : "Detalhar"; ?>" id="evento<?= $s->getIdEvento(); ?>">
                                                    </form>
                                                    </article>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            }//FIM DOS SUB EVENTOS
                            ?>
                        </div>
                    </article>
                </div>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>