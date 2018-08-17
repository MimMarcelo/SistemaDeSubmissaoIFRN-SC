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
        <?php //include './includes/menu.php'; ?>
        
        <div id="carregaPagina">
            <section id="conteudo">
                <?php
                    require_once dirname(__FILE__).'/phpClasses/Evento.php';
                ?>
                <h2>Lista de eventos</h2>
                <div id="atualizavel">
                    <table id="idTabela" cellspacing="0">
                        <thead>
                            <th onclick="ordenarTabela('idTabela', 0)">
                                Dias
                            </th>
                            <th onclick="ordenarTabela('idTabela', 1)">
                                Evento
                            </th>
                            <th>
                                Local
                            </th>
                            <th>
                                Ações
                            </th>
                        </thead>
                        <tbody>
                            
                    <?php
                    $listaEventos = Evento::getTodosEventos();
                    
                    if($listaEventos != null){
                        
                        $hoje = date("Y-m-d");  //DIA ATUAL
                        foreach($listaEventos as $evento){
                            
                            //VERIFICA SE AS INSCRIÇÕES PARA O EVENTO JÁ ESTÃO ENCERRADAS
                            $inscricaoEncerrada = FALSE;
                            if(_Util::periodoValido($evento->getFinalInscricao(), $hoje)){
                                $inscricaoEncerrada = TRUE;                                
                            }
                            
                            //CRIA OBJETO COM INFORMAÇÕES DA RELAÇÃO DO USUÁRIO COM O EVENTO
                            $usuarioEvento = $usuario->getEvento($evento->getIdEvento());
                            
                            $statusInscricao = "Inscreva-se";
                            if(($usuarioEvento) instanceof UsuarioEvento){
                                $statusInscricao = $usuarioEvento->getStatusInscricao()->getStatusInscricao();
                            }
                            else if($inscricaoEncerrada){
                                $statusInscricao = "Inscrições encerradas";
                            }
                            else if(_Util::periodoValido($hoje, $evento->getInicioInscricao())){
                                $statusInscricao = "A partir de ".$evento->getInicioInscricao();
                            }
                            ?>
                            
                            <tr>
                                <td class="centralizado">
                                    <?=$evento->getInicioEvento();?><br>-<br><?=$evento->getFinalEvento();?>
                                </td>
                                <td>
                                    <?=$evento->getNome();?>
                                </td>
                                <td class="centralizado">
                                    <a href="https://www.google.com.br/maps/place/<?=$evento->getLocal();?>" target='_blank'>Google Maps</a>
                                </td>
                                <td class="centralizado">
                                    <form action="phpFuncoes/detalharEvento.php" method="post">
                                        <input type="hidden" value="<?=$evento->getIdEvento();?>" name="pId">
                                        <input type="submit" class="botao menosPadding" value="<?php echo ($statusInscricao=="Inscreva-se")?$statusInscricao:"Detalhar";?>" id="evento<?=$evento->getIdEvento();?>">
                                    </form>
                                    <?php if($usuario->ehAdministrador()){?>
                                    <span>
                                        <img src="img/iconFechar.png" class="fechar" title="Excluir evento <?=$evento->getNome();?>"
                                             onclick='abrePopupConfirm("Confirma a exclusão do evento \"<?=$evento->getNome();?>\"?",
                                                         "phpFuncoes/excluirEvento.php",
                                                         "<?=$evento->getIdEvento();?>",
                                                         "<?=$evento->getNome();?>")'>
                                    </span>
                                    <?php }// FECHA IF ADMINISTRADOR ?>
                                </td>
                            </tr>
                            <?php
                        }//FECHA FOREACH
                    }//FECHA VERIFICAÇÃO SE EVENTOS É DIFERENTE DE NULL
                    ?>
                        
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>