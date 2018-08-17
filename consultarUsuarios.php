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
        <?php //include './includes/menu.php'; ?>
        <div id="carregaPagina">
            <section id="conteudo">
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
                <form action="phpFuncoes/consultarUsuarios.php" method="post">
                    <label for="pNome" class="etiqueta">Nome</label>
                    <input type="text" id="pNome" name="pNome" class="campoDeEntrada">
                    <label for="pAvaliador" class="etiqueta">Avaliador</label>
                    <select id="pAvaliador" name="pAvaliador" class="campoDeEntrada">
                        <option value="-1">Todas opções</option>
                        <option value="0">Não avaliadores</option>
                        <option value="1">Apenas avaliadores</option>
                        <option value="2">Pretendem ser avaliadores</option>
                    </select>
                    <label for="pAdministrador" class="etiqueta">Administrador</label>
                    <select id="pAdministrador" name="pAdministrador" class="campoDeEntrada">
                        <option value="-1">Todas opções</option>
                        <option value="0">Não administradores</option>
                        <option value="1">Apenas administradores</option>
                    </select>
                    <input type="submit" value="Filtrar" class="botao">
                </form>
                <form action="phpFuncoes/editarAvaliadoresAdms.php" method="post">
                    <div id="atualizavel">
                        <?php
                        include './phpFuncoes/consultarUsuarios.php';
                        ?>
                    </div>
                    <input type="submit" value="Executar alterações" class="botao">
                </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>