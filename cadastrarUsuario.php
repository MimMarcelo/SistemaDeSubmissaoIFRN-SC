<?php
    require_once dirname(__FILE__).'/includes/sessaoDeUsuario.php';
    
    if(!$usuario->ehAdministrador() && !empty($usuario->getId())){//SE ESTIVER LOGADO E
        header("location: inicio.php");//NÃO FOR O ADMINISTRADOR, REDIRECIONAR PARA A TELA INICIAL
    }
    /*
     * NESTA PÁGINA O LOGIN NÃO É OBRIGATÓRIO
     * MAS SE ESTIVER LOGADO, APENAS O ADIMINISTRADOR PODE TER ACESSO
     */
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="description" content="tela de cadastro de usuário">
        <meta name="keywords" content="usuario, ifrn, cadastro">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Cadastro</title>
        <?php include './includes/css.php'; ?>
        <?php include './includes/javascript.php'; ?>
    </head>
    <body>
        <?php 
            if($usuario->ehAdministrador()){
                include './includes/cabecalho.php';
                include './includes/menu.php';
            } //FIM DA ÁREA DE ADMINISTRADOR
        ?>
        <div id="carregaPagina">
            <section id="conteudo">
                <!-- O CONTEÚDO DAS PÁGINAS DEVE APARECER AQUI -->
                
                <form action="<?php echo htmlspecialchars("phpFuncoes/cadastrarUsuario.php"); ?>" method="post" enctype="multipart/form-data">
                    <label for="txtCpf">CPF</label>
                    <input type="text" id="txtCpf" name="pCpf" class="cpf" autofocus required>
                    <label for="txtNome">Nome completo</label>
                    <input type="text" id="txtNome" name="pNome" required placeholder="Nome que aparecerá nos certificados">
                    <label for="txtEmail">e-mail</label>
                    <input type="text" id="txtEmail" name="pEmail" required placeholder="Informe seu e-mail">
                    <label for="txtSenha">Senha</label>
                    <input type="password" id="txtSenha" name="pSenha" required>
                    <label for="txtConfirmarSenha">Confirmar senha</label>
                    <input type="password" id="txtConfirmarSenha" name="pConfirmarSenha" class="confirmarSenha" required>
                    <label for="txtMatricula">Matrícula SUAP</label>
                    <input type="text" id="txtMatricula" name="pMatricula" placeholder="Informe sua matrícula SUAP">
                    <?php
                        if($usuario->ehAdministrador()){
                            //INICIA ÁREA QUE APENAS O ADMINISTRADOR PODE EXECUTAR
                    ?>
                    <label for="sltNivelAcesso">Nível Acesso</label>
                    <select id="sltNivelAcesso" name="pNivelAcesso">
                        <option disabled selected>Selecione</option>
                        <?php
                            $listaNivelAcesso = NivelAcesso::getTodosNiveisAcesso();
                            if(is_array($listaNivelAcesso)){
                                foreach($listaNivelAcesso as $nivelAcesso){
                                    echo "<option value='".$nivelAcesso->getId()."'>".$nivelAcesso->getDescricao()."</option>";
                                }

                            }
                        ?>
                    </select>
                    <label for="sltStatusInscricao">Status da inscricao</label>
                    <select id="sltStatusInscricao" name="pStatusInscricao">
                        <option disabled selected>Selecione</option>
                        <?php
                            $listaStatusInscricao = StatusInscricao::getTodosStatusInscricao();
                            if(is_array($listaStatusInscricao)){
                                foreach($listaStatusInscricao as $statusInscricao){
                                    echo "<option value='".$statusInscricao->getId()."'>".$statusInscricao->getStatusInscricao()."</option>";
                                }                            
                            }
                        ?>
                    </select>
                    <label for="ckbAvaliador">
                        Avaliador
                        <input type="checkbox" name="pAvaliador" id="ckbAvaliador">
                    </label>
                    <?php
                        }//FECHA O IF SE É ADMINISTRADOR
                    ?>
                    <label for="imgInp">Foto</label>
                    <input type="file" id="imgInp" name="pImagem" class="upImagem">                
                    <input type="submit" class="botao" value="Cadastrar">

                    <a href="index.php">Já é cadastrado? Faça login</a>
                </form>
            </section>
        </div>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>
