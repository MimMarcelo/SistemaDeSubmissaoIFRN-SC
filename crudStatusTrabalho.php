<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="Evento, IFRN-SC, IFRN, Santa Cruz, sistema">
        <meta name="description" content="Página inicial do sistema de submissão de trabalhos do IFRN campus Santa Cruz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - CRUD Status Trabalho</title>
        <?php 
        include './includes/css.php';
        include './includes/javascript.php';
        require_once dirname(__FILE__) . '/includes/sessaoDeUsuario.php';

        loginObrigatorio(); //LOGIN OBRIGATÓRIO
        
        if (!$usuario->ehAdministrador()) {//SE
            header("location: inicio.php"); //NÃO FOR O ADMINISTRADOR, REDIRECIONAR PARA A TELA INICIAL
        }
        ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        
        <div id="carregaPagina">
            <section id="conteudo">
                <?php
                    require_once dirname(__FILE__).'/phpClasses/StatusTrabalho.php';
                ?>
                <h2>Gerenciar Status Trabalho</h2>
                <button 
                     onclick='abrePopupForm("Criar Status Trabalho",
                                 "Criar", "phpFuncoes/cadastrarStatusTrabalho.php",
                                 <?php
                                 echo json_encode(array(
                                     "pStatusTrabalho"=>""));
                                 ?>,
                                 {
                                     pStatusTrabalho:["text", "Status trabalho"]
                                 });
                                 return false;'>
                    Criar Status Trabalho
                </button>
                <div id="atualizavel">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Descrição</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listaStatusTrabalho = StatusTrabalho::getTodosStatusTrabalho();
                            
                            if($listaStatusTrabalho != null){
                                if(is_object($listaStatusTrabalho[0])){
                                    foreach($listaStatusTrabalho as $status){
                                ?>
                                        <tr>
                                            <td><?php echo $status->getId() ?></td>
                                            <td><?php echo $status->getDescricao() ?></td>
                                            <td>
                                                <span>
                                                    <img src="img/iconEditar.png"
                                                         onclick='abrePopupForm("Editar Status Trabalho",
                                                                     "Editar", "phpFuncoes/editarStatusTrabalho.php",
                                                                     <?php
                                                                     echo json_encode(array(
                                                                         "pIdStatusTrabalho"=>$status->getId(),
                                                                         "pStatusTrabalho"=>$status->getDescricao()));
                                                                     ?>,
                                                                     {
                                                                         pIdStatusTrabalho:["hidden", ""],
                                                                         pStatusTrabalho:["text", "Status trabalho"]
                                                                     });
                                                                     return false;'>
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    <img src="img/iconFechar.png"
                                                         onclick='abrePopupConfirm("Confirma a exclusão do status \"<?php echo $status->getDescricao(); ?>\"?",
                                                                     "phpFuncoes/excluirStatusTrabalho.php",
                                                                     "<?php echo $status->getId(); ?>",
                                                                     "<?php echo $status->getDescricao(); ?>")'>
                                                </span>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                else{
                                    echo "<tr><td colspan='4'>Nenhum registro encontrado!</td></tr>";
                                }
                            }
                            else{
                                echo "<tr><td colspan='4'>Nenhum registro encontrado!</td></tr>";
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