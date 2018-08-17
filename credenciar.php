<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Consulta de usuários</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio();
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
                        $_SESSION["mensagem"] = "Selecione um evento!";
                        header("location: listarEventos.php");
                    }
                } else {
                    $_SESSION["mensagem"] = "Selecione um evento!";
                    header("location: listarEventos.php");
                }
                $inscritos = Usuario::consultarInscritosPorEvento($evento->getIdEvento(), 1);
                ?>
                <div id="atualizavel">
                    <h2><?= $evento->getNome() ?></h2>
                    <h2>Inscritos</h2>
                    <?php
                    if (is_string($inscritos)) {
                        echo $inscritos;
                    } else {
                        //print_r($inscritos);
                        ?>
                        <div class="divTabela" id="tblInscritos">
                            <ul class="cabecalho">
                                <li>Nome</li>
                                <li>CPF</li>
                                <li>e-mail</li>
                                <li>Credenciar</li>
                            </ul>
                            <?php
                                                    foreach ($inscritos as $inscrito){
                                                        ?>
                            <ul>
                                <li>
                                    <?=$inscrito->getNome(); ?>
                                </li>
                                <li>
                                    <?=$inscrito->getCpf(); ?>
                                </li>
                                <li>
                                    <?=$inscrito->getEmail(); ?>
                                </li>
                                <li>
                                    <form action="<?= htmlspecialchars("phpFuncoes/credenciar.php");?>" method="post">
                                        <input type="hidden" value="<?=$inscrito->getId();?>" name="pIdUsuario">
                                        <input type="hidden" value="<?=$evento->getIdEvento();?>" name="pIdEvento">
                                        <input type="submit" value="Credenciar">
                                    </form>
                                </li>
                            </ul>
                            
                    <?php } ?>
                        </div>
                    <?php } ?>
                </div>

            </section>
        </div>
<?php include './includes/rodape.php'; ?>
    </body>
</html>