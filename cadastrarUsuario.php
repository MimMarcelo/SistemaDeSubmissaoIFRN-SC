<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="description" content="tela de cadastro de usuário">
        <meta name="keywords" content="usuario, ifrn, cadastro">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Cadastro</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        if (!$usuario->ehAdministrador() && !empty($usuario->getId())) {//SE ESTIVER LOGADO E
            header("location: inicio.php"); //NÃO FOR O ADMINISTRADOR, REDIRECIONAR PARA A TELA INICIAL
        }
        
        /*
         * NESTA PÁGINA, O LOGIN NÃO É OBRIGATÓRIO
         * MAS SE ESTIVER LOGADO, APENAS O ADIMINISTRADOR PODE TER ACESSO
         */
        ?>
    </head>
    <body>
        <?php
        
        $editar = false;
        
        if ($usuario->ehAdministrador()) {
            include './includes/cabecalho.php';
            //include './includes/menu.php';
            
            if(isset($_GET['id'])){
                $editar = true;
                $usr = Usuario::consultarUsuario('', '', '', '', -1, -1, $_GET['id']);
            }
        } //FIM DA ÁREA DE ADMINISTRADOR
        
        //CONSTROI LISTA DAS ÁREAS DE ATUAÇÃO
        include_once './phpClasses/AreaAtuacao.php';
        $areasAtuacao = AreaAtuacao::getTodasAreasAtuacao();
        
        echo "<datalist id='listAreasAtuacao'>";
        foreach ($areasAtuacao as $area){
            echo "<option value='".$area->getIdAreaAtuacao()."'>".$area->getAreaAtuacao()."</option>";
        }
        echo "</datalist>";
        ?>
        <div id="carregaPagina">
            <section id="conteudo">
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->

                <form action="<?= htmlspecialchars("phpFuncoes/cadastrarUsuario.php");?>" method="post" enctype="multipart/form-data">
                    <label for="txtCpf" class="etiqueta">CPF</label>
                    <input type="text" id="txtCpf" name="pCpf" class="campoDeEntrada cpf" autofocus required <?= $editar?'value="'.$usr->getCpf().'" disabled':'';?>>
                    <label for="txtNome" class="etiqueta">Nome completo</label>
                    <input type="text" id="txtNome" name="pNome" class="campoDeEntrada" required placeholder="Nome que aparecerá nos certificados"<?= $editar?'value="'.$usr->getNome().'"':'';?>>
                    <label for="txtEmail" class="etiqueta">e-mail</label>
                    <input type="email" id="txtEmail" name="pEmail" class="campoDeEntrada" required placeholder="Informe seu e-mail" <?= $editar?'value="'.$usr->getEmail().'"':'';?>>
                    <label for="txtSenha" class="etiqueta">Senha</label>
                    <input type="password" id="txtSenha" name="pSenha" class="campoDeEntrada" required>
                    <label for="txtConfirmarSenha" class="etiqueta">Confirmar senha</label>
                    <input type="password" id="txtConfirmarSenha" name="pConfirmarSenha" class="campoDeEntrada confirmarSenha" required>
                    <label for="txtMatricula" class="etiqueta">Matrícula SUAP</label>
                    <input type="text" id="txtMatricula" class="campoDeEntrada" name="pMatricula" placeholder="Informe sua matrícula SUAP"<?= $editar?'value="'.$usr->getMatricula().'"':'';?>>
                    <label class="etiqueta">
                        Candidatar-se como avaliador:
                        <input type="checkbox" id="candidatoAAvaliador" onclick="confirmaAvaliador(this)" value="candidato">
                    </label>
                    <?php
                    if ($usuario->ehAdministrador()) {
                        //INICIA ÁREA QUE APENAS O ADMINISTRADOR PODE EXECUTAR
                    ?>
                        <label for="ckbAdministrador" class="etiqueta">
                            Administrador
                            <input type="checkbox" name="pAdministrador" id="ckbAdministrador" <?php if($editar){ echo $usr->ehAdministrador()?'checked':'';}?>>
                        </label>
                        <label for="ckbAvaliador" class="etiqueta">
                            Avaliador
                            <input type="checkbox" name="pAvaliador" id="ckbAvaliador" <?php if($editar){ echo ($usr->getAvaliador()>0)?'checked':'';}?>>
                        </label>
                    <?php
                    }//FECHA O IF SE É ADMINISTRADOR
                    ?>
                    <label for="imgInp" class="etiqueta">Foto <span>(Máximo 5MB)</span></label>
                    <input type="file" id="imgInp" name="pImagem" class="upImagem" placeholder="Preview da imagem do usuário" <?= $editar?'value="'.$usr->getImagem().'"':'';?>>
                    <input type="submit" class="botao" value="Cadastrar">
                    <?php
                    if (!$usuario->ehAdministrador()) {
                        //INICIA ÁREA QUE APENAS O ADMINISTRADOR PODE EXECUTAR
                    ?>
                        <a href="index.php">Já é cadastrado? Faça login</a>
                    <?php
                    }//FECHA O IF SE É ADMINISTRADOR
                    ?>
                </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>
