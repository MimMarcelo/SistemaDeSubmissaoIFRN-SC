<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="description" content="tela do login do usuario cadastrado">
        <meta name="keywords" content="usuario, ifrn, login">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Login</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';

        require dirname(__FILE__) . '/includes/sessaoDeUsuario.php';
        if (!empty($usuario->getId())) {//SE JÁ ESTIVER LOGADO, REDIRECIONAR PARA A TELA DE INÍCIO
            header("location: inicio.php");
        }
        ?>
    </head>
    <body>
        <header>
            <div id="barraSuperior">
                <h1>
                    <a href="index.php" title="Início" class="logo">
                        <img src="img/logo250.png" alt="Logomarca do Sistema de Submissão IFRN">
                        <span>Sistema de Submissão</span>
                    </a>
                </h1>
                <nav class="paginaLogin">
                    <a id="texto" href="cadastrarUsuario.php" title="Cadastre-se">CADASTRE-SE</a>
                </nav>
            </div>
        </header>
        <section id="conteudo" class="paginaLogin">
            <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
            <div>
                <!--<img id="logo" src="img/logo250.png" alt="Logomarca do Sistema de Submissão do IFRN-Santa Cruz">-->
                <h1>Sistema de Submissão</h1>
                <form action="<?php echo htmlspecialchars("phpFuncoes/login.php"); ?>" method="post" autocomplete="off" class="painelDegrade paginaLogin">
                    <label for="txtCpf" class="etiqueta">CPF</label>
                    <input type="text" id="txtCpf" name="cpf" class="cpf campoDeEntrada" placeholder="Ex.: 123.123.123-00" autofocus required>
                    <label for="txtSenha" class="etiqueta">Senha</label>
                    <input type="password" id="txtSenha" name="senha" required class="campoDeEntrada">
                    <input type="submit" class="botao inscrevase" value="Acessar">

                    <a href="cadastrarUsuario.php" title="Cadastre-se">Cadastre-se</a>
                    <!--<a href="index.html">Esqueceu sua senha?</a>-->
                </form>
            </div>
        </section>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>
