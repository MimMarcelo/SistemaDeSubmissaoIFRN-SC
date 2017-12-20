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
        require_once dirname(__FILE__).'/includes/sessaoDeUsuario.php';

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
                    <h2 class="detalhes"><span>Evento: </span><?php echo $evento->getNome() ?></h2>
                    <?php if(strlen($evento->getLogoMarca()) > 0 ){ ?>
                    <img src="img/fotosEventos/<?php echo $evento->getLogoMarca() ?>" alt="<?php echo $evento->getDescricao() ?>">
                    <?php }?>
                    <ul class="detalhes">
                        <li>
                            <span>Descricao: </span>
                            <?php echo $evento->getDescricao() ?>
                        </li>
                        <li>
                            <span>Local: </span>
                            <?php echo "<a href='https://www.google.com.br/maps/place/".$evento->getLocal()."' target='_blank'>".$evento->getLocal()."</a>" ?>
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
                            de <?php echo $evento->getInicioInscricao() ?>
                            a <?php echo $evento->getFinalInscricao() ?>
                            
                            <?php
                            //var_dump($usuario->estaInscritoNoEvento($evento->getIdEvento()));
                            $hoje = date("Y-m-d");
                            if((_Util::getDataParaBd($evento->getInicioInscricao()) <= $hoje &&
                                _Util::getDataParaBd($evento->getFinalInscricao()) >= $hoje) &&
                                !$usuario->estaInscritoNoEvento($evento->getIdEvento())){
                            ?>
                            <form action="phpFuncoes/inscreverEmEvento.php" method="post">
                                <input type="hidden" name="pIdEvento" value="<?php echo $evento->getIdEvento(); ?>">
                                <input type="hidden" name="pEvento" value="<?php echo $evento->getNome(); ?>">
                                <input type="submit" value="Inscreva-se">
                            </form>
                            <?php
                            }
                            ?>
                        </li>
                        <?php
                        if(strlen($evento->getInicioSubmissao()) > 0){
                        ?>
                        <li>
                            <span>Submissão de trabalhos: </span>
                            de <?php echo $evento->getInicioSubmissao() ?>
                            a <?php echo $evento->getFinalSubmissao() ?>
                            
                            <?php
                            if(_Util::getDataParaBd($evento->getInicioSubmissao()) <= $hoje &&
                                _Util::getDataParaBd($evento->getFinalSubmissao()) >= $hoje){
                            ?>
                            <a href="submeterTrabalho.php">submeter</a>
                            <?php
                            }
                        ?>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                            <span>Realização: </span>
                            de <?php echo $evento->getInicioEvento() ?>
                            a <?php echo $evento->getFinalEvento() ?>
                        </li>
                    </ul>
                    <?php
                    if(strlen($evento->getIdEventoPrincipal()) > 0){
                    ?>
                    <form action="phpFuncoes/detalharEvento.php" method="post" class="itemAcessivel">
                            <input type="hidden" value="<?php echo $evento->getIdEventoPrincipal() ?>" name="pId">
                            <h3>Voltar para evento principal</h3>
                            <input type="submit" value="Acessar">
                        </form>
                    <?php
                    }
                    if($usuario->estaInscritoNoEvento($evento->getIdEvento())){
                        $subEventos = $evento->getSubEventos();

                        if($subEventos != null){
                            foreach ($subEventos as $subEvento){
                        ?>
                                <form action="phpFuncoes/detalharEvento.php" method="post" class="itemAcessivel">
                                    <input type="hidden" value="<?php echo $subEvento->getIdEvento() ?>" name="pId">
                                    <input type="hidden" value="0" name="pPrincipal">
                                    <h3><?php echo $subEvento->getNome() ?></h3>
                                    <p><?php echo substr($subEvento->getDescricao(), 0, 68)."..."; ?></p>
                                <input type="submit" value="Acessar">
                                </form>
                        <?php
                            }
                        }
                    }
                    ?>
                </div>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>