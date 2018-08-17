<nav>
    <a href="inicio.php" title="Início">Início</a>
    <a href="consultarEventos.php" title="Lista de Eventos">Eventos</a>
    <!--<a href="consultarAvaliacoes.php" title="Consultar avaliações">Avaliações</a>-->
    <?php
    if ($usuario->ehAdministrador()) {
        //OPÇÕES RESTRITAS AO ADMINISTRADOR
        ?>
        <nav class="dropdown">
            <button class="dropdownBtn">
                Administrador
            </button>
            <div>
                <a href="consultarUsuarios.php" title="Consultar usuários">Consultar Usuários</a>
                <a href="cadastrarUsuario.php" title="Cadastrar usuário">Cadastrar Usuário</a>
                <a href="cadastrarEvento.php" title="Cadastrar evento">Cadastrar Evento</a>
                <!--        <a href="crudStatusInscricao.php" title="Status inscricao">Gerenciar Status Inscrição</a>
                            <a href="crudStatusTrabalho.php" title="Status trabalho">Gerenciar Status Trabalho</a>-->
            </div>
        </nav>
        <?php
    }//FIM DAS OPÇÕES RESTRITAS AO ADMINISTRADOR
    ?>
    <a class="menuSair" href="phpFuncoes/logout.php" title="Sair">Sair</a>
    <!-- CRIA OPÇÃO DO MENU PARA EXPANDIR -->
    <a href="javascript:void(0);" onclick="abreMenu()" class="opcoes">
        <span class="barra1"></span>
        <span class="barra2"></span>
        <span class="barra3"></span>
    </a>
</nav>
