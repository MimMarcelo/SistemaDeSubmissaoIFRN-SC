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
                    <h2><span>Evento: </span><?php echo $evento->getNome() ?></h2>
                    <img src="img/fotosEventos/<?php echo $evento->getLogoMarca() ?>" alt="<?php echo $evento->getDescricao() ?>">
                    <ul>
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
                            //print_r($usuario->getEvento($evento->getIdEvento()));
                            $hoje = date("Y-m-d");
                            if((_Util::getDataParaBd($evento->getInicioInscricao())<= $hoje &&
                                _Util::getDataParaBd($evento->getFinalInscricao())>=$hoje) &&
                                !($usuario->getEvento($evento->getIdEvento()) instanceof UsuarioEvento)){
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
                        <li>
                            <span>Submissão de trabalhos: </span>
                            de <?php echo $evento->getInicioSubmissao() ?>
                            a <?php echo $evento->getFinalSubmissao() ?>
                        </li>
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