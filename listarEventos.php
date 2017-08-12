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
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="desaparecer">Local</th>
                                <th>Inscrições</th>
                                <th class="desaparecer">Realização</th>
                                <?php
                                if($usuario->ehAdministrador()){
                                ?>
                                <th>Editar</th>
                                <th>Excluir</th>
                                <?php
                                }
                                else{
                                ?>
                                <th>Inscreva-se</th>
                                <?php
                                }
                                ?>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listaEventos = Evento::getTodosEventos();
                            if($listaEventos != null){
                                foreach($listaEventos as $evento){
                                    $hoje = date("Y-m-d");
                                    $inscricaoEncerrada = FALSE;
                                    if(!(_Util::getDataParaBd($evento->getInicioInscricao())<= $hoje &&
                                        _Util::getDataParaBd($evento->getFinalInscricao())>=$hoje)){
                                        $inscricaoEncerrada = TRUE;
                                    }
                            ?>
                                    <tr title="<?php echo $evento->getDescricao() ?>" <?php echo $inscricaoEncerrada?"class='desabilitado'":"" ?>>
                                        <td><?php echo $evento->getNome() ?></td>
                                        <td class="desaparecer"><?php echo $evento->getLocal() ?></td>
                                        <td><?php echo $evento->getInicioInscricao()." - ".$evento->getFinalInscricao() ?></td>
                                        <td class="desaparecer"><?php echo $evento->getInicioEvento()." - ".$evento->getFinalEvento() ?></td>
                                        <?php
                                        if($usuario->ehAdministrador()){
                                        ?>
                                        <td>
                                            <span>
                                                <form action="phpFuncoes/detalharEvento.php" method="post">
                                                    <input type="hidden" value="<?php echo $evento->getIdEvento() ?>" name="pId">
                                                    <input type="image" src="img/iconEditar.png">
                                                </form>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <img src="img/iconFechar.png"
                                                     onclick='abrePopupConfirm("Confirma a exclusão do evento \"<?php echo $evento->getNome(); ?>\"?",
                                                                 "phpFuncoes/excluirEvento.php",
                                                                 "<?php echo $evento->getIdEvento(); ?>",
                                                                 "<?php echo $evento->getNome(); ?>")'>
                                            </span>
                                        </td>
                                        <?php
                                        }
                                        else{                                            
                                        ?>
                                        <td>
                                            <span>
                                                <form action="phpFuncoes/detalharEvento.php" method="post">
                                                    <input type="hidden" value="<?php echo $evento->getIdEvento() ?>" name="pId">
                                                    <input type="image" src="img/iconDetalhar.png">
                                                </form>
                                                <p>
                                                <?php
                                                    if(($usuario->getEvento($evento->getIdEvento()) instanceof UsuarioEvento) || $inscricaoEncerrada){
                                                        echo "Detalhar";
                                                    }
                                                    else{
                                                        echo "Inscreva-se";
                                                    }
                                                ?>
                                                </p>
                                            </span>
                                        </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                            <?php
                                }
                            }
                            else{
                                echo "<tr><td colspan='".($usuario->ehAdministrador()?6:5)."'>Nenhum evento encontrado!</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>