<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Campos dos formulários</title>
        <?php 
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio(); //LOGIN OBRIGATÓRIO
        ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>

        <div id="carregaPagina">
            <section id="conteudo">
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
                <?php include './includes/popup.php'; ?>
                <div id="atualizavel">

                </div>
                <h2>Teste dos campos de formulários</h2>
                <form action="phpFuncoes/_testeEnvioJQuery.php" enctype="multipart/form-data" method="post">

                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe seu nome..." autofocus required>
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome" placeholder="Informe seu sobrenome..." value="Júnior" required>
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Informe sua senha..." required>
                    <label for="email">e-mail</label>
                    <input type="email" id="email" name="email" placeholder="Informe seu e-mail...">
                    <label for="arquivo">Selecionar arquivo</label>
                    <input type="file" id="arquivo" name="teste" required>                

                    <label for="lista">Navegadores</label>
                    <input type="text" list="navegadores" id="lista" name="navegador">
                    <datalist id="navegadores">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Chrome">
                        <option value="Opera">
                        <option value="Safari">
                    </datalist> 
                    <label for="resumo" name="resumo">Resumo</label>
                    <textarea id="resumo" rows="10"></textarea>
                    <label for="pais">País de origem</label>
                    <select id="pais" name="pais">
                        <option selected disabled>Selecione</option>
                        <optgroup label="Europeu">
                            <option value="Espanha">Espanha</option>
                            <option value="Inglaterra">Inglaterra</option>
                        </optgroup>
                        <optgroup label="Latino">
                            <option value="Brasil">Brasil</option>
                            <option value="Argentina">Argentina</option>
                        </optgroup>
                    </select>
                    <fieldset>
                        <legend>Período</legend>

                        <label for="dataInicio">De</label>
                        <input type="text" id="dataInicio" class="calendario" name="inicio">
                        <label for="dataFim">Até</label>
                        <input type="text" id="dataFim" class="calendario" name="fim">
                    </fieldset>
                    <fieldset>
                        <legend>Sexo</legend>                    
                        <label>
                            <input type="radio" name="sexo" value="F" checked id="rFeminino">
                            Feminino
                        </label>
                        <label>
                            <input type="radio" name="sexo" value="M" id="rMasculino">
                            Masculino
                        </label>
                    </fieldset>
                    <fieldset>
                        <legend>Selecione vários</legend>
                        <label for="cPortuguês">
                            <input type="checkbox" name="idioma[]" value="português" id="cPortuguês">
                            Português
                        </label>
                        <label for="cIngles">
                            <input type="checkbox" name="idioma[]" value="ingles" id="cIngles">
                            Inglês
                        </label>
                        <label for="cEspanhol">
                            <input type="checkbox" name="idioma[]" value="espanhol" id="cEspanhol">
                            Espanhol
                        </label>
                        <label for="cItaliano">
                            <input type="checkbox" name="idioma[]" value="italiano" id="cItaliano">
                            Italiano
                        </label>
                    </fieldset>
                    <button>Botão</button>
                    <input type="button" value="Button">
                    <input type="reset" value="Limpar Campos">
                    <input type="submit" value="Submit">

                </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>