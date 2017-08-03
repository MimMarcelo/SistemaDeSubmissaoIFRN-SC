<nav>
    <ul>
        <li><a href="inicio.php" title="Início">Home</a></li>
        <li><a href="crudStatusTrabalho.php" title="Status trabalho">CRUD Status Trabalho</a></li>
        <li><a href="consultarAvaliacoes.php" title="Consultar avaliações">Consultar Avaliações</a></li>
        <li><a href="testeCamposFormulario.php" title="Campos dos forms">Campos dos FORMs</a></li>
        <?php
            if($usuario->ehAdministrador()){
                //OPÇÕES RESTRITAS AO ADMINISTRADOR
        ?>
        <li>Administrador</li>
        <li><a href="cadastrarUsuario.php" title="Cadastrar Usuário">Cadastrar Usuário</a></li>
        <li><a href="cadastrarEvento.php" title="Cadastrar Evento">Cadastrar Evento</a></li>
        <li><a href="crudStatusInscricao.php" title="Status inscricao">Gerenciar Status Inscrição</a></li>
        <?php
            }//FIM DAS OPÇÕES RESTRITAS AO ADMINISTRADOR
        ?>
    </ul>
</nav>
