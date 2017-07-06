<!DOCTYPE html>
<?php
    //SESSAO PARA IMPORTS
    require dirname(__FILE__).'/phpClasses/StatusTrabalho.php';
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - CRUD Status Trabalho</title>
        <?php include './includes/css.php'; ?>
        <?php include './includes/javascript.php'; ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        
        <section id="conteudo">
            <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
            <?php include './includes/popup.php'; ?>
            <h2>CRUDs para Status Trabalho</h2>
            <p>Lista todos Status já cadastrados</p>
            <div id="atualizavel">
                <?php
                    $resultado = StatusTrabalho::getTodosStatusTrabalho();
                    if($resultado != null){
                        echo "<ul>";
                        while($obj = $resultado->fetch_object()){
                            echo "<li>Id: ".$obj->idStatusTrabalho." - Descrição: ".$obj->descricao."</li>";
                        }
                        echo "</ul>";
                    }
                ?>
            </div>
            <p>Formulário para criar novo Status Trabalho</p>
            <form action="phpFuncoes/cadastrarStatusTrabalho.php" method="post">
                <label for="txtNomeStatusTrabalho">Nome do Status a ser criado: </label>
                <input type="text" id="txtNomeStatusTrabalho" name="pStatusTrabalho" placeholder="Novo Status">
                <input type="submit" value="Salvar">
            </form>
            <p>Formulário para editar Status Trabalho</p>
            <form action="phpFuncoes/editarStatusTrabalho.php" method="post">
                <label for="sltStatusTrabalho">Selecione o Status a ser modificado: </label>
                <select id="sltStatusTrabalho" name="pIdStatusTrabalho">
                    <?php
                        $resultado = StatusTrabalho::getTodosStatusTrabalho();
                        while($obj = $resultado->fetch_object()){
                            echo "<option value='".$obj->idStatusTrabalho."'>".$obj->descricao."</option>";
                        }
                    ?>
                </select>
                <label for="txtNovoNomeStatusTrabalho">Informe a nova descrição do Status: </label>
                <input type="text" id="txtNovoNomeStatusTrabalho" name="pStatusTrabalho" placeholder="Nova descrição">
                <input type="submit" value="Salvar">
            </form>
            <p>Formulário para excluir Status Trabalho</p>
            <form action="phpFuncoes/excluirStatusTrabalho.php" method="post">
                <label for="sltStatusTrabalho">Selecione o Status a ser excluído: </label>
                <select id="sltStatusTrabalho" name="pIdStatusTrabalho">
                    <?php
                        $resultado = StatusTrabalho::getTodosStatusTrabalho();
                        while($obj = $resultado->fetch_object()){
                            echo "<option value='".$obj->idStatusTrabalho."'>".$obj->descricao."</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Excluir">
            </form>
        </section>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>