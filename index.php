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
            <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
            <h1>Login</h1>
            <form>
                <label for="txtCpf">CPF:</label>
                <input type="text" id="txtCpf" name="cpf" class="cpf" autofocus required>
                <label for="txtSenha">Senha:</label>
                <input type="password" id="txtSenha" name="senha" required>
                <input type="submit" value="LOGIN"> 
            </form>
        </section>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>
