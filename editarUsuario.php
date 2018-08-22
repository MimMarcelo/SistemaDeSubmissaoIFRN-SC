<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="description" content="tela de edição de usuário">
        <meta name="keywords" content="usuario, ifrn, cadastro">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Editar</title>
        <?php
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';
        
        loginObrigatorio(); //LOGIN OBRIGATÓRIO
        
        ?>
    </head>
    <body>
        <?php
        
            include './includes/cabecalho.php';
        if ($usuario->ehAdministrador()) {    
            if(isset($_GET['id'])){
                $usr = Usuario::consultarUsuario('', '', '', '', -1, -1, $_GET['id']);
            }
            else{
                $usr = $usuario;
            }
        } //FIM DA ÁREA DE ADMINISTRADOR
        else{
            $usr = $usuario;
        }
        
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

                <form action="<?= htmlspecialchars("phpFuncoes/editarUsuario.php");?>" method="post" enctype="multipart/form-data">
                    <label for="txtCpf" class="etiqueta">CPF</label>
                    <input type="text" id="txtCpf" name="pCpf" class="campoDeEntrada cpf" autofocus required value="<?= $usr->getCpf(); ?>" disabled>
                    <label for="txtNome" class="etiqueta">Nome completo</label>
                    <input type="text" id="txtNome" name="pNome" class="campoDeEntrada" required placeholder="Nome que aparecerá nos certificados" value="<?= $usr->getNome(); ?>">
                    <label for="txtEmail" class="etiqueta">e-mail</label>
                    <input type="email" id="txtEmail" name="pEmail" class="campoDeEntrada" required placeholder="Informe seu e-mail" value="<?= $usr->getEmail(); ?>">
                    <label for="txtSenha" class="etiqueta">Senha</label>
                    <input type="password" id="txtSenha" name="pSenha" class="campoDeEntrada">
                    <label for="txtConfirmarSenha" class="etiqueta">Confirmar senha</label>
                    <input type="password" id="txtConfirmarSenha" name="pConfirmarSenha" class="campoDeEntrada confirmarSenha">
                    <label for="txtMatricula" class="etiqueta">Matrícula SUAP</label>
                    <input type="text" id="txtMatricula" class="campoDeEntrada" name="pMatricula" placeholder="Informe sua matrícula SUAP" value="<?= $usr->getMatricula(); ?>">
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
                            <input type="checkbox" name="pAdministrador" id="ckbAdministrador" <?= $usr->ehAdministrador()?'checked':''; ?>>
                        </label>
                        <label for="ckbAvaliador" class="etiqueta">
                            Avaliador
                            <input type="checkbox" name="pAvaliador" id="ckbAvaliador" <?= ($usr->getAvaliador()>0)?'checked':''; ?>>
                        </label>
                    <?php
                    }//FECHA O IF SE É ADMINISTRADOR
                    ?>
                    <label for="txtSenhaAtual" class="etiqueta">Senha Atual</label>
                    <input type="password" id="txtSenhaAtual" name="pSenhaAtual" class="campoDeEntrada" required>
                    <input type="submit" class="botao" value="Atualizar">
                    
                </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>
