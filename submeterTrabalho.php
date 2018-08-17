<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página de submissão dos trabalhos a serem apresentados no evento">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Submissão de trabalho</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/phpClasses/Evento.php';
        require_once dirname(__FILE__) . '/phpClasses/AreaAtuacao.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio();
        ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php //include './includes/menu.php'; ?>
        <div id="carregaPagina">
            <section id="conteudo">
                <?php
                $evento = new Evento();
                if (isset($_SESSION["evento"])) {
                    if (!empty($_SESSION["evento"])) {
                        $evento = $_SESSION["evento"];
                    } else {
                        $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                        header("location: listarEventos.php");
                    }
                } else {
                    $_SESSION["mensagem"] = "Selecione um evento para detalhar!";
                    header("location: listarEventos.php");
                }
                
                //CONSTROI LISTA DE PARTICIPANTES DO EVENTO
                include_once './phpClasses/UsuarioEvento.php';
                $usuariosDoEvento = UsuarioEvento::getTodosUsuariosEvento($evento->getIdEvento());
                
                echo "<datalist id='listUsuariosEvento'>";
                echo "<option disabled selected>Selecione</option>";
                foreach ($usuariosDoEvento as $usuarioEvento){
                    //print_r($usuarioEvento);
                    //print_r(Usuario::consultarUsuario(0, '', '', '', -1, -1, $usuarioEvento->getIdUsuario()));
                    echo "<option value='".$usuarioEvento->getIdUsuario()."'>".Usuario::consultarUsuario(0, '', '', '', -1, -1, $usuarioEvento->getIdUsuario())->getNome()."</option>";
                }
                echo "</datalist>";
                
                //CONSTROI LISTA DAS ÁREAS DE ATUAÇÃO
                include_once './phpClasses/AreaAtuacao.php';
                $areasAtuacao = AreaAtuacao::getTodasAreasAtuacao();

                echo "<datalist id='listAreasAtuacao'>";
                foreach ($areasAtuacao as $area){
                    echo "<option value='".$area->getIdAreaAtuacao()."'>".$area->getAreaAtuacao()."</option>";
                }
                echo "</datalist>";
                ?>
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
                <h2 class="detalhes">
                    <span>Submissão de trabalhos para:</span>
                    <br>
                    <?php
                    $nome = "";
                    if ($evento->getIdEventoPrincipal() <> 0) {
                        $nome = Evento::getEventoPorId($evento->getIdEventoPrincipal(), 0)->getNome();
                        $nome .= "<br>(" . $evento->getNome() . ")";
                    } else {
                        $nome = $evento->getNome();
                    }
                    echo $nome;
                    ?>
                </h2>
                <form action="<?= htmlspecialchars("phpFuncoes/cadastrarTrabalho.php");?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$usuario->getId();?>" name="pCoAutor[]">
                    <input type="hidden" value="<?=$evento->getIdEvento();?>" name="pEvento">
                    <fieldset>
                        <legend>Autores</legend>
                        <div class="divTabela" id="tblAutores">
                            <ul class="cabecalho">
                                <li>Ori.</li>
                                <li>Nome</li>
                                <li>Excluir</li>
                            </ul>
                            <ul>
                                <li>
                                    <input type="checkbox" value="<?=$usuario->getId();?>" name="pOrientador[]" placeholder="É orientador?">
                                </li>
                                <li>
                                    Autor: <?php echo $usuario->getNome(); ?>
                                </li>
                                <li>
                                    
                                </li>
                            </ul>
                        </div>
                        <input type="button" value="Adicionar coautor" onclick="adicionarCoAutor('#tblAutores', 'pOrientador', 'pCoAutor', '#listUsuariosEvento')">
                    </fieldset>
                    <fieldset>
                        <legend>Área(s) de atuação do trabalho</legend>
                        <input type="button" value="Adicionar Area" onclick="adicionarSelectDinamicamente(this, '#listAreasAtuacao', 'pAreaAtuacao')" required>
                    </fieldset>
                    <label for="txtInstituicao">Instituição</label>
                    <input type="text" id="txtInstituicao" name="pInstituicao" placeholder="Informe a que instituição a produção do trabalho está vinculada" required>
                    <label for="txtTitulo">Título do trabalho</label>
                    <input type="text" id="txtTitulo" name="pTitulo" placeholder="Título do trabalho" required>
                    <label for="txtResumo">Resumo</label>
                    <textarea id="txtResumo" name="pResumo" placeholder="Faça um resumo breve do trabalho" rows="10" required></textarea>
                    <label for="txtPalavrasChave">Palavras chave (separe cada termo com vírgula)</label>
                    <input type="text" id="txtPalavrasChave" name="pPalavrasChave" required>
                    <label for="txtArquivo">Arquivo (PDF)</label>
                    <input type="file" id="txtArquivo" name="pArquivo" required>
                    <input type="submit" value="Submeter">
                </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>