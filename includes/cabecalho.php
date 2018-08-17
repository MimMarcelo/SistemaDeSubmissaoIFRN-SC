<header>
    <div id="barraSuperior">
        <h1>
            <a href="index.php" title="Início" class="logo">
                <img src="img/logo250.png" alt="Logomarca do Sistema de Submissão IFRN">
                <span>Sistema de Submissão</span>
            </a>
        </h1>
        <?php include_once 'includes/menu.php'; ?>
    </div>
    <div id="usuario">
        <img src="upload/usuarios/<?= $usuario->getImagem(); ?>" alt="imagem de perfil de <?= $usuario->getNome(); ?>" />
        <div  class="painelDegrade">
            <p>
                CPF: <?= $usuario->getCpf(); ?>,
                e-mail: <?= $usuario->getEmail(); ?>
            </p>
            <p class="nome"><?= $usuario->getNome(); ?></p>
            <p>Nível de acesso:
                <?php
                if ($usuario->ehAdministrador()) {
                    echo "Adminstrador";
                } else {
                    echo "Usuário";
                }
                ?>
            </p>
        </div>
    </div>
<!--    <form action="phpFuncoes/detalharEvento.php" method="post">
        <select name="pId">
            <option>Selecione um evento</option>
            <?php
//            $eventos = Evento::getTodosEventos();
//            //print_r($eventos);
//            //print_r($_SESSION);
//            if (isset($_SESSION["evento"])) {
//                $evento = $_SESSION["evento"];
//            } else {
//                $evento = new Evento();
//            }
//            foreach ($eventos as $e) {
//                $opcao = '<option value="' . $e->getIdEvento() . '" ';
//                $opcao .= $evento->getIdEvento() === $e->getIdEvento() ? 'selected' : '';
//                $opcao .= '>' . $e->getNome() . '</option>';
//                echo "$opcao";
//            }
            ?>
        </select>
    </form>-->
</header>
