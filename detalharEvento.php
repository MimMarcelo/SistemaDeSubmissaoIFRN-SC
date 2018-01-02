<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Detalhar Evento</title>
        <?php 
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__).'/phpClasses/Evento.php';
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
                $evento = new Evento();
                if(isset($_SESSION["evento"])){
                    if(!empty($_SESSION["evento"])){
                        $evento = $_SESSION["evento"];
                        //unset($_SESSION["evento"]);
                    }
                    else{
                        $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                        header("location: listarEventos.php");
                    }
                }
                else{
                    $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                    header("location: listarEventos.php");
                }
                ?>
                <div id="atualizavel">
                    <h2><span>Evento: </span><?=$evento->getNome() ?></h2>
                    <img src="img/fotosEventos/<?=$evento->getLogoMarca() ?>" alt="<?=$evento->getDescricao() ?>">
                    <ul>
                        <li>
                            <span>Descricao: </span>
                            <?=$evento->getDescricao() ?>
                        </li>
                        <li>
                            <span>Local: </span>
                            <a href='https://www.google.com.br/maps/place/<?=$evento->getLocal();?>' target='_blank'><?=$evento->getLocal();?></a>
                        </li>
                        <li>
                            <span>Número de vagas: </span>
                            <?php
                            $vagas = $evento->getNumVagas();
                            if($vagas < 1){
                                echo "Ilimitado";
                            }
                            else{
                                echo "$vagas";
                            }
                            ?>
                        </li>
                        <li>
                            <span>Inscrições: </span>
                            de <?=$evento->getInicioInscricao() ?>
                            a <?=$evento->getFinalInscricao() ?>
                            
                            <?php
                            
                            //CRIA OBJETO COM INFORMAÇÕES DA RELAÇÃO DO USUÁRIO COM O EVENTO
                            $usuarioEvento = $usuario->getEvento($evento->getIdEvento());
                            
                            $hoje = date("Y-m-d");
                            //VERIFICA SE PODE SE INSCREVER
                            $podeSeInscrever = TRUE;
                            $statusInscricao = "Inscreva-se";
                            if(($usuarioEvento) instanceof UsuarioEvento){
                                $podeSeInscrever = FALSE;//JÁ ESTÁ INSCRITO
                                $statusInscricao = $usuarioEvento->getStatusInscricao()->getStatusInscricao();
                            }
                            else if(_Util::periodoValido($evento->getFinalInscricao(), $hoje)){
                                $podeSeInscrever = FALSE;//INSCRIÇÕES ENCERRADAS 
                                $statusInscricao = "Inscrições encerradas";
                            }
                            else if(_Util::periodoValido($hoje, $evento->getInicioInscricao())){
                                $podeSeInscrever = FALSE;//INSCRIÇÕES AINDA NÃO ABERTAS 
                                $statusInscricao = "Inscrições a partir de ".$evento->getInicioInscricao();
                            }
                            
                            if($statusInscricao == "Inscreva-se"){
                            ?>
                            <form action="phpFuncoes/inscreverEmEvento.php" method="post">
                                <input type="hidden" name="pIdEvento" value="<?=$evento->getIdEvento(); ?>">
                                <input type="hidden" name="pEvento" value="<?=$evento->getNome(); ?>">
                                <input type="submit" value="Inscreva-se">
                            </form>
                            <?php
                            }
                            else{
                                echo "<span>$statusInscricao</span>";
                            }
                            ?>
                        </li>
                        <?php
                        //VERIFICAÇÃO SE ACEITA SUBMISSÃO DE TRABALHOS
                        if($evento->getInicioSubmissao() != ""){
                        ?>
                        <li>
                            <span>Submissão de trabalhos: </span>
                            de <?php echo $evento->getInicioSubmissao() ?>
                            a <?php echo $evento->getFinalSubmissao() ?>
                            <?php
                            $podeSubmeter = TRUE;
                            if(_Util::periodoValido($evento->getFinalSubmissao(), $hoje)){
                                $podeSeInscrever = FALSE;//INSCRIÇÕES ENCERRADAS 
                                $statusInscricao = "Submissões encerradas";
                            }
                            else if(_Util::periodoValido($hoje, $evento->getInicioSubmissao())){
                                $podeSeInscrever = FALSE;//INSCRIÇÕES AINDA NÃO ABERTAS 
                                $statusInscricao = "Submissões a partir de ".$evento->getInicioInscricao();
                            }
                            if($podeSubmeter){
                            ?>
                            <form action="phpFuncoes/inscreverEmEvento.php" method="post">
                                <input type="hidden" name="pIdEvento" value="<?=$evento->getIdEvento(); ?>">
                                <input type="hidden" name="pEvento" value="<?=$evento->getNome(); ?>">
                                <input type="submit" value="Submeta trabalhos">
                            </form>
                            <?php
                            }
                            else{
                                echo "<span>$statusInscricao</span>";
                            }
                            ?>
                        </li>
                        <?php
                            }//FIM DA VERIFICAÇÃO SE ACEITA SUBMISSÃO DE TRABALHOS
                            ?>
                        <li>
                            <span>Realização: </span>
                            de <?php echo $evento->getInicioEvento() ?>
                            a <?php echo $evento->getFinalEvento() ?>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>