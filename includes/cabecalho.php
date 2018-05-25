<header>
    <img src="img/fotosUsuarios/<?=$usuario->getImagem();?>" alt="imagem de perfil de <?=$usuario->getNome();?>" />
    <h1>Sistema de Submissão - IFRN SC</h1>
    <p><?=$usuario->getNome();?>!</p>
    <p>Nível de acesso:
        <?php
        if ($usuario->ehAdministrador()) {
            echo "Adminstrador";
        }
        else {
            echo "Usuário";
        }
        ?>
    </p>
    <form action="phpFuncoes/detalharEvento.php" method="post">
        <select name="pId">
        <option>Selecione um evento</option>
        <?php
                require_once dirname(__FILE__).'/../phpClasses/Evento.php';
        $eventos = Evento::getTodosEventos();
        if(isset($_SESSION["evento"])){
            $evento = $_SESSION["evento"];
        }
        else{
            $evento = new Evento();
        }
        foreach ($eventos as $e){
            $opcao = '<option value="'.$e->getIdEvento().'" ';
            $opcao .= $evento->getIdEvento()===$e->getIdEvento()?'selected':'';
            $opcao .= '>'.$e->getNome().'</option>';
            echo "$opcao";
        }
        ?>
    </select>
    </form>
</header>
