<!DOCTYPE html>
<?php
    //SESSAO PARA IMPORTS
    require dirname(__FILE__).'/phpClasses/StatusInscricao.php';
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Início</title>
        <?php include './includes/css.php'; ?>
        <?php include './includes/javascript.php'; ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        <section id="conteudo">
            <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
            <h2>Título</h2>
            <p id="content">Exemplo de como consultar o banco de dados</p>
            <p>Lista todos os Status de inscrição cadastrados</p>
            <ul>
                <?php
                    $resultado = StatusInscricao::getTodosStatusInscricao();
                    while($obj = $resultado->fetch_object()){
                        echo "<li>Id: ".$obj->idStatusInscricao." - Descrição: ".$obj->descricao."</li>";
                    }
                ?>
            </ul>
            <p>Formulário para criar novo Status Inscrição</p>
            <form action="phpFuncoes/cadastrarStatusInscricao.php" method="get">
                <label for="txtNomeStatusInscricao">Nome do Status a ser criado: </label>
                <input type="text" id="txtNomeStatusInscricao" name="pStatusInscricao" placeholder="Novo Status">
                <input type="submit" value="Salvar">
            </form>
            <p>Formulário para editar Status Inscrição</p>
            <form action="phpFuncoes/editarStatusInscricao.php" method="get">
                <label for="sltStatusInscricao">Selecione o Status a ser modificado: </label>
                <select id="sltStatusInscricao" name="pIdStatusInscricao">
                    <?php
                        $resultado = StatusInscricao::getTodosStatusInscricao();
                        while($obj = $resultado->fetch_object()){
                            echo "<option value='".$obj->idStatusInscricao."'>".$obj->descricao."</option>";
                        }
                    ?>
                </select>
                <label for="txtNovoNomeStatusInscricao">Informe o status correto</label>
                <input type="text" id="txtNovoNomeStatusInscricao" name="pStatusInscricao" placeholder="Novo Status">
                <input type="submit" value="Salvar">
            </form>
            <p>Formulário para editar Status Inscrição</p>
            <form action="phpFuncoes/excluirStatusInscricao.php" method="get">
                <label for="sltStatusInscricao">Selecione o Status a ser modificado: </label>
                <select id="sltStatusInscricao" name="pIdStatusInscricao">
                    <?php
                        $resultado = StatusInscricao::getTodosStatusInscricao();
                        while($obj = $resultado->fetch_object()){
                            echo "<option value='".$obj->idStatusInscricao."'>".$obj->descricao."</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Excluir">
            </form>
        </sectio>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>