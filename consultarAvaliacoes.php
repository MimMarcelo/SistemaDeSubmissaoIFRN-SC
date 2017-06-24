<!DOCTYPE html>
<?php
    //SESSAO PARA IMPORTS
    require dirname(__FILE__).'/phpClasses/Avaliacao.php';
    
    //INICIA AS VARIÁVEIS COM OS VALORES PADRÃO DO FORMULÁRIO
    $idEvento=0;
    $idUsuario=0;
    $idStatusTrabalho=0;
    $concluida=2;
    $ehFinal=2;
    $titulo='';
    $resumo='';
    
    //QUANDO O USUÁRIO REALIZA ALGUMA CONSULTA, VERIFICAR OS CAMPOS QUE FORAM INFORMADOS
    if(isset($_GET)){
        if(isset($_GET["evento"])){
            if(!empty($_GET["evento"])){
                $idEvento = $_GET["evento"];
            }
        }
        if(isset($_GET["avaliador"])){
            if(!empty($_GET["avaliador"])){
                $idUsuario = $_GET["avaliador"];
            }
        }
        if(isset($_GET["statusTrabalho"])){
            if(!empty($_GET["statusTrabalho"])){
                $idStatusTrabalho = $_GET["statusTrabalho"];
            }
        }
        if(isset($_GET["concluida"])){
            //if(!empty($_GET["concluida"])){ //NÃO DEVE TESTAR O EMPTY POR CAUSA DA POSSIBILIDADE DE UM VALOR = 0
                $concluida = $_GET["concluida"];
            //}
        }
        if(isset($_GET["escopo"])){
            //if(!empty($_GET["escopo"])){ //NÃO DEVE TESTAR O EMPTY POR CAUSA DA POSSIBILIDADE DE UM VALOR = 0
                $ehFinal = $_GET["escopo"];
            //}
        }
        if(isset($_GET["titulo"])){
            if(!empty($_GET["titulo"])){
                $titulo = $_GET["titulo"];
            }
        }
        if(isset($_GET["resumo"])){
            if(!empty($_GET["resumo"])){
                $resumo = $_GET["resumo"];
            }
        }
    }
    $resultado = Avaliacao::getAvaliacoes($idEvento, 0, 0, $idUsuario, $idStatusTrabalho, $concluida, $ehFinal, $titulo, $resumo);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Consultar avaliações</title>
        <?php include './includes/css.php'; ?>
        <?php include './includes/javascript.php'; ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        <section id="conteudo">
            <h2>Consultar Avaliações</h2>
            <form>
                <input type="hidden" value="consultarAvaliacoes" name="pagina">
                <label for="sltEvento">Evento:</label>
                <select id="sltEvento" name="evento" autofocus>
                    <option value="0">Selecione</option>
                    <?php
                        $eventos = array(1, "Expotec", 2, "Inexistente");

                        for($i = 0; $i < count($eventos); $i = $i+2){
                            if($idEvento == $eventos[$i]){
                                echo "<option value='".$eventos[$i]."' selected>".$eventos[$i+1]."</option>";
                            }
                            else{
                                echo "<option value='".$eventos[$i]."'>".$eventos[$i+1]."</option>";
                            }
                        }
                    ?>
                </select>
                
                <label for="sltAvaliador">Avaliador:</label>
                <select id="sltAvaliador" name="avaliador">
                    <option value="0">Selecione</option>
                    <?php
                        $avaliadores = array(3, "Marcelo Júnior", 7, "Larissa Richelly");

                        for($i = 0; $i < count($avaliadores); $i = $i+2){
                            if($idUsuario == $avaliadores[$i]){
                                echo "<option value='".$avaliadores[$i]."' selected>".$avaliadores[$i+1]."</option>";
                            }
                            else{
                                echo "<option value='".$avaliadores[$i]."'>".$avaliadores[$i+1]."</option>";
                            }
                        }
                    ?>
                </select>

                <label for="sltStatusTrabalho">Status do trabalho:</label>
                <select id="sltStatusTrabalho" name="statusTrabalho">
                    <option value="0">Selecione</option>
                    <?php
                        $statusTrabalho = array(1, "Enviado", 2, "Em avaliação", 3, "Status de teste");

                        for($i = 0; $i < count($statusTrabalho); $i = $i+2){
                            if($idStatusTrabalho == $statusTrabalho[$i]){
                                echo "<option value='".$statusTrabalho[$i]."' selected>".$statusTrabalho[$i+1]."</option>";
                            }
                            else{
                                echo "<option value='".$statusTrabalho[$i]."'>".$statusTrabalho[$i+1]."</option>";
                            }
                        }
                    ?>
                </select>
                
                <label for="sltConcluida">Avaliações:</label>
                <select id="sltConcluida" name="concluida">
                    <option value="2">Todas</option>
                    <?php
                        $concluidas = array(0, "Em andamento", 1, "Concluídas");

                        for($i = 0; $i < count($concluidas); $i = $i+2){
                            if($concluida == $concluidas[$i]){
                                echo "<option value='".$concluidas[$i]."' selected>".$concluidas[$i+1]."</option>";
                            }
                            else{
                                echo "<option value='".$concluidas[$i]."'>".$concluidas[$i+1]."</option>";
                            }
                        }
                    ?>
                </select>
                
                <label for="sltEscopo">Escopo:</label>
                <select id="sltEscopo" name="escopo">
                    <option value="2">Todos</option>
                    <?php
                        $escopos = array(0, "Submetidos", 1, "Aprovados");

                        for($i = 0; $i < count($escopos); $i = $i+2){
                            if($ehFinal == $escopos[$i]){
                                echo "<option value='".$escopos[$i]."' selected>".$escopos[$i+1]."</option>";
                            }
                            else{
                                echo "<option value='".$escopos[$i]."'>".$escopos[$i+1]."</option>";
                            }
                        }
                    ?>
                </select>
                
                <label for="txtTitulo">Trecho do título:</label>
                <input type="text" id="txtTitulo" name="titulo" value="<?php echo $titulo; ?>">
                <label for="txtResumo">Trecho do resumo:</label>
                <input type="text" id="txtResumo" name="resumo" value="<?php echo $resumo; ?>">
                <input type="submit" value="Consultar">
            </form>
            <ul>
                <?php

                    while($obj = $resultado->fetch_object()){
                        echo "<li>Id: ".$obj->idAvaliacaoTrabalho." - Título: ".$obj->titulo."</li>";
                    }
                ?>
            </ul>
        </section>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>