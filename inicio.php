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
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
                <h2>Eventos inscrito</h2>
                <div class="centralizado">
                    <?php
                    $eventosPorUsuario = UsuarioEvento::getUsuarioEvento($usuario->getId(), 0, 0, 0);
                    if (is_array($eventosPorUsuario)) {
                        foreach ($eventosPorUsuario as $eUsuario) {
                            echo "<div class='cartao'>";
                            $e = Evento::getEventoPorId($eUsuario->getIdEvento(), -1);
                            echo "<img src='upload/eventos/" . $e->getLogoMarca() . "'>";
                            echo "<h4>" . $e->getNome() . "</h4>";
                            ?>
                            <form action="phpFuncoes/detalharEvento.php" method="post">
                                <input type="hidden" value="<?= $e->getIdEvento(); ?>" name="pId">
                                <?php
                                if ($e->getIdEventoPrincipal() > 0) {
                                    ?>
                                    <input type="hidden" value="<?= $e->getIdEventoPrincipal(); ?>" name="pIdPrincipal">
                                    <?php
                                }
                                ?>
                                <input type="submit" class="inscrevase" value="<?= $eUsuario->getStatusInscricao()->getStatusInscricao(); ?>">
                            </form>
                            <form action="phpFuncoes/detalharEvento.php" method="post">
                                <input type="hidden" value="<?= $e->getIdEvento(); ?>" name="pId">
                                <?php
                                if ($e->getIdEventoPrincipal() > 0) {
                                    ?>
                                    <input type="hidden" value="<?= $e->getIdEventoPrincipal(); ?>" name="pIdPrincipal">
                                    <?php
                                }
                                ?>
                                <input type="submit" class="inscrevase saibaMais" value="Saiba mais">
                            </form>
                            <?php
                            //echo "<a href='#' class='inscrevase'>" . $eUsuario->getStatusInscricao()->getStatusInscricao() . "</a>";
                            //echo "<a href='#' class='inscrevase saibaMais'>Saiba mais</a>";
                            echo "</div>";
                        }
                    } else {
                        echo $eventosPorUsuario;
                    }
                    ?>
                </div>
                <h2>Trabalhos submetidos</h2>
                <?php
                $trabalhos = $usuario->getTrabalhos();
//                if (is_string($trabalhos)) {
//                    echo $trabalhos;
//                } else {
//                    foreach ($trabalhos as $t) {
//                        echo "Trabalho: " . $t->getTitulo() . "<br>";
//                        //print_r($t->getStatusTrabalho());
//                        echo "Status: " . $t->getStatusTrabalho()->getDescricao() . "<br><br>";
//                    }
//                }
                ?>
                <div class="divTabela">
                    <ul class="cabecalho" id="idTabela">
                        <li onclick="ordenarTabela('idTabela', 1)">ID</li>
                        <li>Trabalho</li>
                        <li>Evento</li>
                        <li>Status</li>
                    </ul>
                    <?php
                    if (is_array($trabalhos)) {// SE O RESULTADO FOR DIFERENTE DE NULL
                        //ESSE CÓDIGO VAI APARECER NA div#atualizavel DA PÁGINA
                        foreach ($trabalhos as $t) {
                            echo "<ul>";
                            echo "<li>";
                            echo $t->getIdTrabalho();
                            echo "</li>";
                            echo "<li>";
                            echo $t->getTitulo();
                            echo "</li>";
                            echo "<li>";
                            echo $t->getEvento()->getNome();
                            echo "</li>";
                            echo "<li>";
                            echo $t->getStatusTrabalho()->getDescricao();
                            echo "</li>";
                            echo "</ul>";
                        }
                        //FIM DO CÓDIGO QUE APARECE NA div#atualizavel DA PÁGINA
                    } else {
                        //CASO NÃO TENHA ENCONTRADO NENHUM RESULTADO
                        echo "Nenhum registro encontrado!";
                    }
                    ?>
                </div>

            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>