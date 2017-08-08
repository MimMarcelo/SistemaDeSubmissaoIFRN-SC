<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="ifrn , eventos,  subimissao, Santa Cruz">
        <meta name="description" content="Formulario para fazer os cadastros de eventos para o IFRN-SC">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Cadastrar evento</title>
        <?php 
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio(); //LOGIN OBRIGATÓRIO

        if (!$usuario->ehAdministrador() && !empty($usuario->getId())) {//SE ESTIVER LOGADO E
            header("location: inicio.php"); //NÃO FOR O ADMINISTRADOR, REDIRECIONAR PARA A TELA INICIAL
        }
        ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        
        <div id="carregaPagina">
            <section id="conteudo">
                <?php
                    require_once dirname(__FILE__).'/phpClasses/Evento.php';
                ?>
                <h2>Cadastrar evento</h2>
                <form action="phpFuncoes/cadastrarEvento.php" method="post">
                    <label for="sltEventoPrincipal">Evento principal ou subevento</label>
                    <select id="sltEventoPrincipal" name="pEventoPrincipal" autofocus required>
                        <option value="0">Principal</option>
                        <?php
                        $listaEventos = Evento::getTodosEventos();
                        if($listaEventos != null){
                            foreach($listaEventos as $evento){
                                echo "<option value='".$evento->getIdEvento()."'>".$evento->getNome()."</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="txtNome">Nome do Evento</label>
                    <input type="text" id="txtNome" name="pNome" placeholder="Nome do evento" required>
                    <label for="txtDescricao">Descrição</label>
                    <textarea id="txtDescricao" name="pDescricao" placeholder="Faça um resumo curto sobre o evento..." rows="10" required></textarea>
                    <label for="txtLocal">Local do evento</label>
                    <input type="text" id="txtLocal" name="pLocal" placeholder="Local" required>
                    <label for="txtNumeroVagas">Numero de vagas</label>
                    <input type="number" id="txtNumeroVagas" name="pNumeroVagas" placeholder="0 para ilimitado" min="0" required>
                    <label for="txtLogo">Logo do evento</label>
                    <input type="file" id="txtLogo" name="pImagem">

                    <fieldset>
                        <legend>Realização do evento</legend>
                        <label for="txtDataInicioEvento">Início</label>
                        <input type="text" id="txtDataInicioEvento" onchange="dataLimite(this, '#txtDataFimEvento')" name="pDataInicioEvento" class="calendario" required>
                        <label for="txtDataFimEvento">Fim</label>
                        <input type="text" id="txtDataFimEvento" name="pDataFimEvento" class="calendario" required>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Inscrições</legend>
                        <label for="txtDataInicioInscricao">Início</label>
                        <input type="text" id="txtDataInicioInscricao" onchange="dataLimite(this, '#txtDataFimInscricao')" name="pDataInicioInscricao" class="calendario" required>
                        <label for="txtDataFimInscricao">Fim</label>
                        <input type="text" id="txtDataFimInscricao" name="pDataFimInscricao" class="calendario" required>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Submissão de trabalhos</legend>
                        <label for="txtDataInicioTrabalho">Início</label>
                        <input type="text" id="txtDataInicioTrabalho" onchange="dataLimite(this, '#txtDataFimTrabalho')" name="pDataInicioTrabalho" class="calendario">
                        <label for="txtDataFimTrabalho">Fim</label>
                        <input type="text" id="txtDataFimTrabalho" name="pDataFimTrabalho" class="calendario">
                    </fieldset>
                    <input type="submit" value="Cadastrar Evento">
                 </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>