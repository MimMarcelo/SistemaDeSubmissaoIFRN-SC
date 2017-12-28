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
</header>
