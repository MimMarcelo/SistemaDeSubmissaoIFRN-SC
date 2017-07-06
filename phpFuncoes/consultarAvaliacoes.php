<?php
    //SESSAO PARA IMPORTS
    require dirname(__FILE__).'/../phpClasses/Avaliacao.php';
    
    //INICIA AS VARIÁVEIS COM OS VALORES PADRÃO DO FORMULÁRIO
    $idEvento=0;
    $idUsuario=0;
    $idStatusTrabalho=0;
    $concluida=2;
    $ehFinal=2;
    $titulo='';
    $resumo='';
    
    //ARRAY QUE LISTA AS MENSAGENS DE ERRO ENCONTRADOS
    $mensagem = array();
    $titulo = "";
    
    //QUANDO O USUÁRIO REALIZA ALGUMA CONSULTA, VERIFICAR OS CAMPOS QUE FORAM INFORMADOS
    if(isset($_POST)){
        if(isset($_POST["evento"])){
            if(!empty($_POST["evento"])){
                $idEvento = $_POST["evento"];
            }
        }
        if(isset($_POST["avaliador"])){
            if(!empty($_POST["avaliador"])){
                $idUsuario = $_POST["avaliador"];
            }
        }
        if(isset($_POST["statusTrabalho"])){
            if(!empty($_POST["statusTrabalho"])){
                $idStatusTrabalho = $_POST["statusTrabalho"];
            }
        }
        if(isset($_POST["concluida"])){
            //if(!empty($_POST["concluida"])){ //NÃO DEVE TESTAR O EMPTY POR CAUSA DA POSSIBILIDADE DE UM VALOR = 0
                $concluida = $_POST["concluida"];
            //}
        }
        if(isset($_POST["escopo"])){
            //if(!empty($_POST["escopo"])){ //NÃO DEVE TESTAR O EMPTY POR CAUSA DA POSSIBILIDADE DE UM VALOR = 0
                $ehFinal = $_POST["escopo"];
            //}
        }
        if(isset($_POST["titulo"])){
            if(!empty($_POST["titulo"])){
                $titulo = $_POST["titulo"];
            }
        }
        if(isset($_POST["resumo"])){
            if(!empty($_POST["resumo"])){
                $resumo = $_POST["resumo"];
            }
        }
    }
    
    //EXECUTA A CONSULTA NO BANCO DE DADOS
    $resultado = Avaliacao::getAvaliacoes($idEvento, 0, 0, $idUsuario, $idStatusTrabalho, $concluida, $ehFinal, $titulo, $resumo);
    
    if ($resultado != null) {// SE O RESULTADO FOR DIFERENTE DE NULL
        
        //ESSE CÓDIGO VAI APARECER NA div#atualizavel DA PÁGINA
        echo "<ul>";
        while($obj = $resultado->fetch_object()) {
            echo "<li>id: " . $obj->idAvaliacaoTrabalho. " - Título: " . $obj->titulo. " - Avaliações finalizadas: " . $obj->avaliacoesFinalizadas."</li>";
        }
        echo "</ul>";
        //FIM DO CÓDIGO QUE APARECE NA div#atualizavel DA PÁGINA
        
    } else {
        //CASO NÃO TENHA ENCONTRADO NENHUM RESULTADO
        $mensagem[] = "Nenhum registro encontrado!";
        $titulo = "Atenção";
    }
    
    if(count($mensagem) > 0){
        echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
    }