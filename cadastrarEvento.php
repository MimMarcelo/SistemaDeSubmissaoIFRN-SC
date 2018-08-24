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
        <?php //include './includes/menu.php'; ?>
        
        <div id="carregaPagina">
            <section id="conteudo">
                <?php
                    require_once dirname(__FILE__).'/phpClasses/Evento.php';
                ?>
                <h2>Cadastrar evento</h2>
                <form action="<?= htmlspecialchars("phpFuncoes/cadastrarEvento.php");?>" method="post" enctype="multipart/form-data">
                    <label for="sltEventoPrincipal" class="etiqueta">Evento principal ou subevento</label>
                    <select id="sltEventoPrincipal" class="campoDeEntrada" name="pEventoPrincipal" autofocus required>
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
                    <label for="txtNome" class="etiqueta">Nome do Evento</label>
                    <input type="text" id="txtNome" class="campoDeEntrada" name="pNome" placeholder="Nome do evento" required>
                    <label for="txtDescricao" class="etiqueta">Descrição</label>
                    <textarea id="txtDescricao" class="campoDeEntrada" rows="5" name="pDescricao" placeholder="Faça um resumo curto sobre o evento..." required></textarea>
                    <label for="txtLocal" class="etiqueta">Local do evento</label>
                    <input type="text" id="txtLocal" class="campoDeEntrada" name="pLocal" placeholder="Local" required>
                    <label for="txtNumeroVagas" class="etiqueta">Numero de vagas</label>
                    <input type="number" id="txtNumeroVagas" class="campoDeEntrada" name="pNumeroVagas" placeholder="0 para ilimitado" min="0" required>

                    <fieldset>
                        <legend>Realização do evento</legend>
                        <label for="txtDataInicioEvento" class="etiqueta">Início</label>
                        <input type="text" id="txtDataInicioEvento" onchange="dataLimite(this, '#txtDataFimEvento')" name="pDataInicioEvento" class="calendario campoDeEntrada" required>
                        <label for="txtDataFimEvento" class="etiqueta">Fim</label>
                        <input type="text" id="txtDataFimEvento" name="pDataFimEvento" class="calendario campoDeEntrada" required>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Inscrições</legend>
                        <label for="txtDataInicioInscricao" class="etiqueta">Início</label>
                        <input type="text" id="txtDataInicioInscricao" onchange="dataLimite(this, '#txtDataFimInscricao')" name="pDataInicioInscricao" class="calendario campoDeEntrada" required>
                        <label for="txtDataFimInscricao" class="etiqueta">Fim</label>
                        <input type="text" id="txtDataFimInscricao" name="pDataFimInscricao" class="calendario campoDeEntrada" required>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Submissão de trabalhos</legend>
                        <label for="txtDataInicioTrabalho" class="etiqueta">Início</label>
                        <input type="text" id="txtDataInicioTrabalho" onchange="dataLimite(this, '#txtDataFimTrabalho')" name="pDataInicioTrabalho" class="calendario campoDeEntrada">
                        <label for="txtDataFimTrabalho" class="etiqueta">Fim</label>
                        <input type="text" id="txtDataFimTrabalho" name="pDataFimTrabalho" class="calendario campoDeEntrada">
                    </fieldset>
                    <label for="txtLogo" class="etiqueta">Logo do evento</label>
                    <input type="file" id="txtLogo" class="upImagem" name="pImagem">
                    <label for="txtTermosDeUso" class="etiqueta">Termos de uso</label>
                    <input type="file" id="txtTermosDeUso" class="campoDeEntrada" name="pTermosDeUso" required>
                    <fieldset>
                        <legend>Modelos</legend>
                        <fieldset>
                            <legend>Modelo 1</legend>
                            <label for="txtModelo1Desc" class="etiqueta">Descrição</label>
                            <input type="text" id="txtModelo1Desc" class="campoDeEntrada" name="pModelo1Desc">
                            <label for="txtModelo1" class="etiqueta">Arquivo (PDF)</label>
                            <input type="file" id="txtModelo1" class="campoDeEntrada" name="pModelo1">
                        </fieldset>
                        <fieldset>
                            <legend>Modelo 2</legend>
                            <label for="txtModelo2Desc" class="etiqueta">Descrição</label>
                            <input type="text" id="txtModelo2Desc" class="campoDeEntrada" name="pModelo2Desc">
                            <label for="txtModelo2" class="etiqueta">Arquivo (PDF)</label>
                            <input type="file" id="txtModelo2" class="campoDeEntrada" name="pModelo2">
                        </fieldset>
                        <fieldset>
                            <legend>Modelo 3</legend>
                            <label for="txtModelo3Desc" class="etiqueta">Descrição</label>
                            <input type="text" id="txtModelo3Desc" class="campoDeEntrada" name="pModelo3Desc">
                            <label for="txtModelo3" class="etiqueta">Arquivo (PDF)</label>
                            <input type="file" id="txtModelo3" class="campoDeEntrada" name="pModelo3">
                        </fieldset>
                    </fieldset>
                    <input type="submit" value="Cadastrar Evento" class="botao">
                 </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>