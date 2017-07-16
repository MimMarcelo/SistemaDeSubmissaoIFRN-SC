<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="description" content="tela do login do usuario cadastrado">
        <meta name="keywords" content="usuario, ifrn, login">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Login</title>
        <?php include './includes/css.php'; ?>
        <?php include './includes/javascript.php'; ?>
    </head>
    <body>
        <section id="conteudo">
            <?php include './includes/popup.php'; 
                /*
                 * TODA PÁGINA QUE POSSUIR UM FORMULÁRIO PRECISA DESSE INCLUDE
                 */
            ?>
            <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
            <nav id="paginaLogin">
                <div>
                    <form action="phpFuncoes/login.php" method="post" autocomplete="off" class="sincrono">
                        <img id="logo" src="img/logo250.png" alt="Logomarca do Sistema de Submissão do IFRN-Santa Cruz">
                        <label for="txtCpf">CPF</label>
                        <input type="text" id="txtCpf" name="cpf" class="cpf" autofocus required>
                        <label for="txtSenha">Senha</label>
                        <input type="password" id="pasSenha" name="senha" required>
                        <input type="submit" class="botao" value="Acessar">

                        <a href="index.html">Cadastre-se</a>
                        <a href="index.html">Esqueceu sua senha?</a>

                    </form>
                </div>
                <div>
                    <a id="texto" href="index.html">CADASTRE-SE</a>
                    <a id="texto" href="inscricaoUsuario.php">INSCREVER-SE EM EVENTO </a>
                    <a id="texto" href="index.html">SUBMETER TRABALHOS </a>
                    <a id="texto" href="index.php" >CADASTRAR EVENTO </a>
                </div>
            </nav>
        </section>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>
