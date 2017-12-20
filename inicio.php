<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Início</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio();
        ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        <div id="carregaPagina">
            <section id="conteudo">
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
                <p>Você é um visitante!</p>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>