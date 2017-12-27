<nav>
    <!-- CRIA OPÇÃO DO MENU PARA EXPANDIR -->
    <a href="javascript:void(0);" onclick="abreMenu()">
        <span class="barra1"></span>
        <span class="barra2"></span>
        <span class="barra3"></span>
    </a>
    <a href="inicio.php" title="Início">Home</a>
    <a href="listarEventos.php" title="Lista de Eventos">Eventos</a>
    <a href="consultarAvaliacoes.php" title="Consultar avaliações">Consultar Avaliações</a>
    <a href="testeCamposFormulario.php" title="Campos dos forms">Campos dos FORMs</a>
    <?php
        if($usuario->ehAdministrador()){
            //OPÇÕES RESTRITAS AO ADMINISTRADOR
    ?>
    <a class="menuTitulo">Administrador</a>
    <a href="cadastrarUsuario.php" title="Cadastrar usuário">Cadastrar Usuário</a>
    <a href="cadastrarEvento.php" title="Cadastrar evento">Cadastrar Evento</a>
    <a href="crudStatusInscricao.php" title="Status inscricao">Gerenciar Status Inscrição</a>
    <a href="crudStatusTrabalho.php" title="Status trabalho">Gerenciar Status Trabalho</a>
    <?php
        }//FIM DAS OPÇÕES RESTRITAS AO ADMINISTRADOR
    ?>
    <a class="menuSair" href="phpFuncoes/logout.php" title="Sair">Sair</a>
</nav>
