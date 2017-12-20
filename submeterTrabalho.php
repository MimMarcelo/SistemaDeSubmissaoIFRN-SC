<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página de submissão dos trabalhos a serem apresentados no evento">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Submissão de trabalho</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/phpClasses/Evento.php';
        require_once dirname(__FILE__) . '/phpClasses/Area.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio();
        ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        <div id="carregaPagina">
            <section id="conteudo">
                <?php
                $evento = new Evento();
                if (isset($_SESSION["evento"])) {
                    if (!empty($_SESSION["evento"])) {
                        $evento = $_SESSION["evento"];
                    } else {
                        $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                        header("location: listarEventos.php");
                    }
                } else {
                    $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                    header("location: listarEventos.php");
                }
                ?>
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
                <h2 class="detalhes">
                    <span>Submissão de trabalhos para:</span>
                    <?php
                    $nome = "";
                    if ($evento->getIdEventoPrincipal() <> 0) {
                        $nome = Evento::getEventoPorId($evento->getIdEventoPrincipal(), 1)->getNome();
                        $nome .= " (" . $evento->getNome() . ")";
                    } else {
                        $nome = $evento->getNome();
                    }
                    echo $nome;
                    ?>
                </h2>
                <form action="phpFuncoes/submeterTrabalho.php" method="post" enctype="multipart/form-data">
                    <div class="autor">
                        <label>
                            Autor: <?php echo $usuario->getNome(); ?>
                        </label>
                        <label>
                            Orientador
                            <input type="checkbox" id="rbtOrientador" name="pOrientador">
                            <input type="hidden" value="<?php echo $usuario->getId(); ?>" id="txtAutor" name="pAutor">
                        </label>
                    </div>
                     
                    <label>Adicionar co-autor</label>
                    <select id="sltCoAutor" name="pCoAutor">
                        <option selected disabled>Selecione</option>
                        <?php
                        $lista = Usuario::consultarUsuariosPorEvento($evento->getIdEventoPrincipal());
                        if ($lista != null) {
                            foreach ($lista as $u) {
                                if ($usuario->getId() == $u->getId()) {
                                    continue;
                                }
                                echo "<option value='" . $u->getId() . "'>" . $u->getNome() . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="button" value="Adicionar co-autor" onclick="addCoAutor('#txtAutor', '#sltCoAutor', 'CoAutor[]')">
                    <label for="sltArea">Área</label>
                    <select id="sltArea" name="pArea">
                        <option selected disabled>Selecione</option>
                        <?php
                        $lista = Area::consultarAreas(0, '');
                        if ($lista != null) {
                            foreach ($lista as $u) {
                                echo "<option value='" . $u->getIdArea() . "'>" . $u->getArea() . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="txtInstituicao">Instituição</label>
                    <input type="text" id="txtInstituicao" name="pInstituicao" placeholder="Informe a que instituição a produção do trabalho está vinculada">
                    <label for="txtTitulo">Título do trabalho</label>
                    <input type="text" id="txtTitulo" name="pTitulo" placeholder="Título do trabalho" required>
                    <label for="txtResumo">Resumo</label>
                    <textarea id="txtResumo" name="pResumo" placeholder="Faça um resumo breve do trabalho" rows="10" required></textarea>
                    <label for="txtPalavrasChave">Palavras chave (separe cada termo com vírgula)</label>
                    <input type="text" id="txtPalavrasChave" name="pPalavrasChave">
                    <label for="txtArquivo">Arquivo (PDF)</label>
                    <input type="file" id="txtArquivo" name="pArquivo" required>
                    <input type="submit" value="Submeter">
                </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>