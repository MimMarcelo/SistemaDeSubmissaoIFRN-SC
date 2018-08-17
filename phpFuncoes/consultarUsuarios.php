<?php
//SESSAO PARA IMPORTS
require_once dirname(__FILE__) . '/../phpClasses/Usuario.php';
require_once dirname(__FILE__) . '/validaCampos.php';

//INICIA AS VARIÁVEIS COM OS VALORES PADRÃO DO FORMULÁRIO
$nome = '';
$avaliador = -1;
$administrador = -1;

//ARRAY QUE LISTA AS MENSAGENS DE ERRO ENCONTRADOS
$metodoHttp = $_SERVER['REQUEST_METHOD'];
$mensagem = array();
$aux = "";
$titulo = "Atenção";

//QUANDO O USUÁRIO REALIZA ALGUMA CONSULTA, VERIFICAR OS CAMPOS QUE FORAM INFORMADOS
if ($metodoHttp == 'POST') {
    if (isset($_POST["pNome"])) {
        $nome = testaCampo($_POST["pNome"]);
    }
    if (isset($_POST["pAvaliador"])) {
        $avaliador = testaCampo($_POST["pAvaliador"]);
    }
    if (isset($_POST["pAdministrador"])) {
        $administrador = testaCampo($_POST["pAdministrador"]);
    }
}

//EXECUTA A CONSULTA NO BANCO DE DADOS
$resultado = Usuario::consultarUsuarios('', $nome, '', '', $avaliador, $administrador, 0);
?>
<div class="divTabela" id="tblAutores">
    <ul class="cabecalho">
        <li>Nome</li>
        <li>Ava</li>
        <li>Adm</li>
        <!--<li>Editar</li>-->
    </ul>
    <?php
    if ($resultado != null) {// SE O RESULTADO FOR DIFERENTE DE NULL
        //ESSE CÓDIGO VAI APARECER NA div#atualizavel DA PÁGINA
        foreach ($resultado as $usr) {
            echo "<ul>";
            echo "<li>";
            echo $usr->getNome();
            echo "<input type='hidden' name='usuario[]' value='" . $usr->getId() . "'>";
            echo "</li>";
            echo "<li>";
            echo "<input type='checkbox' name='avaliador[]' value='" . $usr->getId() . "'";
            if ($usr->getAvaliador() == 1) {
                echo " checked";
            }
            echo ">";
            echo "</li>";
            echo "<li>";
            echo "<input type='checkbox' name='administrador[]' value='" . $usr->getId() . "'";
            if ($usr->ehAdministrador()) {
                echo " checked";
            }
            echo ">";
            echo "</li>";
            ?>
            <!--<li><a href="cadastrarUsuario.php?id=<? $usr->getId(); ?>">Editar</a></li> -->
            <?php
            echo "</ul>";
        }
        //FIM DO CÓDIGO QUE APARECE NA div#atualizavel DA PÁGINA
    } else {
        //CASO NÃO TENHA ENCONTRADO NENHUM RESULTADO
        $mensagem[] = "Nenhum registro encontrado!";
        $titulo = "Atenção";
    }

    if (count($mensagem) > 0) {
        echo json_encode(array("mensagem" => $mensagem, "titulo" => $titulo));
    }
    ?>
</div>