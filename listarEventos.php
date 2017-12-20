<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Lista de Eventos</title>
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
                <?php
                    require_once dirname(__FILE__).'/phpClasses/Evento.php';
                ?>
                <h2>Lista de eventos</h2>
                <div id="atualizavel">
                <?php
                $listaEventos = Evento::getTodosEventos();
                if($listaEventos != null){
                    foreach($listaEventos as $evento){
                ?>
                        <form action="phpFuncoes/detalharEvento.php" method="post" class="itemAcessivel">
                            <div>
                            <?php
                            if($usuario->ehAdministrador()){
                            ?>
                            <span class="botaoFlutuante">
                                <a href="editarEvento?idEvento=<?php echo $evento->getIdEvento(); ?>">
                                    <img src="img/iconDetalhar.png" alt="Clique para editar o evento">
                                </a>
                                <img src="img/iconFechar.png"
                                     onclick='abrePopupConfirm("Confirma a exclusão do evento \"<?php echo $evento->getNome(); ?>\"?",
                                                 "phpFuncoes/excluirEvento.php",
                                                 "<?php echo $evento->getIdEvento(); ?>",
                                                 "<?php echo $evento->getNome(); ?>")'>
                            </span>
                            <?php } ?>
                            <input type="hidden" value="<?php echo $evento->getIdEvento() ?>" name="pId">
                            <input type="hidden" value="1" name="pPrincipal">
                            <h3><?php echo $evento->getNome() ?></h3>
                            <p><?php echo substr($evento->getDescricao(), 0, 75)."..."; ?></p>
                            </div>
                            <input type="submit" value="Acessar">
                        </form>
                <?php
                    }
                }
                ?>
                </div>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>