<?php

    require_once dirname(__FILE__).'/../phpDao/UsuarioDao.php';
    require_once dirname(__FILE__).'/UsuarioEvento.php';
    require_once dirname(__FILE__).'/AreaAtuacao.php';
    require_once dirname(__FILE__).'/Trabalho.php';
    
class Usuario{
    private $idUsuario;
    private $cpf;
    private $senha;
    private $nome;
    private $email;
    private $matricula;
    private $areasAtuacao;
    private $administrador;
    private $avaliador;
    private $imagem;
    private $trabalhos;
    private $evento;
    private $lattes;
    
    public function getId() {
        return $this->idUsuario;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getlattes() {
        return $this->lattes;
    }

    public function getAreasAtuacao(){
        if($this->areasAtuacao == null){
            $this->areasAtuacao = AreaAtuacao::getAreasPorIdUsuario($this->getId());
        }
        return $this->areasAtuacao;
    }
    
    public function getAreasAtuacaoParaBD(){
        $areasAtuacao = "";
        if(is_array($this->areasAtuacao)){
            foreach ($this->areasAtuacao as $area){
                if($areasAtuacao == ""){
                    $areasAtuacao = $area;
                }
                else{
                    $areasAtuacao = $areasAtuacao.",".$area;
                }
            }
        }
        return $areasAtuacao;
    }
        
    public function getNivelAcesso() {
        return $this->administrador;
    }
    
    public function getStatusInscricao() {
        return $this->statusInscricao;
    }

    public function getAvaliador() {
        return $this->avaliador;
    }

    public function getImagem() {
        if($this->imagem==""){
            return "iconSemFoto.gif";
        }
        return $this->imagem;
    }

    public function getTrabalhos() {
        if($this->trabalhos == null){
            $aux = Trabalho::getTrabalhosPorUsuario($this->idUsuario);
            if(is_array($aux)){
                $this->trabalhos = $aux;
            }
            else{
                return $aux;
            }
        }
        return $this->trabalhos;
    }
    
    public function getEvento($idEvento){
        if($this->evento == null || !is_object($this->evento)){
            $this->evento = new UsuarioEvento();
        }
        if($this->evento->getIdEvento() != $idEvento){
            $this->evento = UsuarioEvento::getUsuarioEvento($this->idUsuario, $idEvento, 0, 0)[0];
        }
        return $this->evento;
    }
    
    public function setId($id){
        $this->idUsuario = $id;
    }
    
    public function setCpf($cpf) {
        if(empty($cpf)){
            return "Informe o CPF";
        }
        else if(strlen($cpf) != 14){
            return "O CPF deve possuir 11 dígitos ";
        }
        else{
            $this->cpf = $cpf;
            return "";
        }
    }

    public function clearSenha() {
        $this->senha = "";
    }

    public function setSenha($senha) {
        if(empty($senha)){
            return "Informe uma senha";
        }
        else if(strlen($senha) < 3){
            return "A senha deve possuir, no mínimo, 3 caracteres: ";
        }
        else{
            $this->senha = md5($senha);
            return "";
        }
    }

    public function setNome($nome) {         
        if(empty($nome)){
            return "Informe o nome de usuário";
        }
        else if (!preg_match("/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇ' ']+$/",$nome)) {
            return "Apenas letras e espaços são permitidos no nome de usuário";
        }
        else{
            $this->nome = $nome;
            return "";
        }
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setLattes($lattes) {
        if(empty($lattes)){
            return "";
        }
        else if (!filter_var($lattes, FILTER_VALIDATE_URL)) {
            return "formato do link do currículo inválido!"; 
        }
        else{
            $this->lattes = $lattes;
            return "";
        }
    }

    public function setAreasAtuacao($areasAtuacao) {
        if (is_array($areasAtuacao)) {
            $this->areasAtuacao = $areasAtuacao;
        }
        else{
            return "Áreas de atuação inválidas";
        }
    }
    
    public function addAreaAtuacao($areaAtuacao){
        if($this->areasAtuacao == null){
            $this->areasAtuacao = array();
        }
        $this->areasAtuacao->append($areaAtuacao);
    }
        
    public function setEmail($email) {           
        if(empty($email)){
            return "Informe o e-mail de usuário";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "formato de e-mail inválido!"; 
        }
        else{
            $this->email = $email;
            return "";
        }
    }

    public function setNivelAcesso($nivelAcesso){
        $this->administrador = $nivelAcesso;
    }

    public function setAvaliador($avaliador) {
        $this->avaliador = $avaliador;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setTrabalhos($trabalhos) {
        if (is_array($trabalhos)) {
            $this->trabalhos = $trabalhos;
        }
    }
    
    public function addTrabalho($trabalho){
        if($this->trabalhos == null){
            $this->trabalhos = array();
        }
        $this->trabalhos->append($trabalho);
    }
    
    public function removeTrabalho($trabalho) {
        foreach (array_keys($trabalhos, $trabalho) as $trab) {
            unset($trabalhos[$trab]);
        }
    }
    
    public function ehAdministrador(){
        return $this->getNivelAcesso() == 1;
    }

    /**
     * VERIFICA SE O USUÁRIO EXISTE NO BANCO DE DADOS
     * @param String $cpf CPF DO USUÁRIO
     * @param String $senha SENHA DO USUÁRIO
     * @return OBJETO DO TIPO USUÁRIO, OU ARRAY DE STRINGs
     */
    public static function login($cpf, $senha){
        $mensagem = array();
        $usuario = null;
        
        $dado = UsuarioDao::login($cpf, $senha);// CONSULTA O BANCO DE DADOS
        if($dado == null){
            $mensagem[] = "Usuário não encontrado";
        }
        else{
            $usuario = new Usuario();
            try{
                foreach ($dado as $obj){
                //while($obj = $dado->fetch_assoc()) {
                    foreach ($obj as $key => $value) {
                        //echo $key.", ".$value."\n";
                        $usuario->{$key} = $value;
                    }
                }
            } catch (Exception $e){
                $usuario = null;
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $usuario;
        }
    }

    public static function consultarUsuario($cpf, $nome, $email, $matricula, $avaliador, $administrador, $idUsuario){      
        $mensagem = null;
        $usuario = null;
        
        $dado = UsuarioDao::consultarUsuario($cpf, $nome, $email, $matricula, $avaliador, $administrador, $idUsuario);
        //print_r($dado);
        
        if($dado == null){
            $mensagem = "Usuário não encontrado";
        }
        else{
            $usuario = new Usuario();
            try{
                foreach ($dado as $obj){
                //while($obj = $dado->fetch_assoc()) {
                    foreach ($obj as $key => $value) {
                        $usuario->{$key} = $value;
                    }
                }
            } catch (Exception $e){
                $usuario = null;
                $mensagem = $e->getMessage();
            }
        }
        if($mensagem != null){
            return $mensagem;
        }
        else{
            return $usuario;
        }
    }
    public static function consultarUsuarios($cpf, $nome, $email, $matricula, $avaliador, $administrador, $idUsuario){      
        $mensagem = array();
        $usuarios = array();
        
        $dado = UsuarioDao::consultarUsuario($cpf, $nome, $email, $matricula, $avaliador, $administrador, $idUsuario);
        //print_r($dado);
        
        if($dado == null){
            $mensagem[] = "Usuário não encontrado";
        }
        else{
            foreach ($dado as $obj){
                $usuario = new Usuario();
                foreach ($obj as $key => $value) {
                    $usuario->{$key} = $value;
                }
                $usuarios[] = $usuario;
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
        else{
            return $usuarios;
        }
    }
    public static function alterarAvaliadoresAdms($idUsuarios, $avaliadores, $adms){
        return UsuarioDao::alterarAvaliadoresAdms($idUsuarios, $avaliadores, $adms);
    }
    
    public function salvar(){
        $mensagem = array();
        $dado = null;
        
        //VERIFICA SE O CPF INSERIDO JÁ ESTÁ CADASTRADO
        $dado = Usuario::consultarUsuario($this->cpf, '', '', '', -1, -1, 0);
        if(!is_object($dado)){
            
            //VERIFICA SE O E-MAIL INSERIDO JÁ ESTÁ CADASTRADO
            $dado = Usuario::consultarUsuario('', '', $this->email, '', -1, -1, 0);
            if(!is_object($dado)){
                
                $dado = UsuarioDao::salvar($this->cpf, $this->senha, $this->nome, $this->email, $this->matricula, $this->avaliador, $this->imagem, $this->administrador, $this->idUsuario, $this->getAreasAtuacaoParaBD(), $this->lattes);
            }
            else{
                $mensagem[] = "O e-mail '$this->email' já é cadastrado no sistema, esqueceu a senha?";
            }
        }
        else{
            $mensagem[] = "CPF '$this->cpf' já está cadastrado no sistema, esqueceu a senha?";
        }
        if($dado == null){
            $mensagem[] = "Não foi possível cadastrar o usuário";
        }
        else if(count($mensagem) == 0){
            try{
                foreach ($dado as $obj){
                //while($obj = $dado->fetch_assoc()) {
                    //print_r($obj);
                    if($obj["idUsuario"] > 0){
                        return $obj["idUsuario"];
                    }
                }
            }
            catch (Exception $e){
                $mensagem[] = $e->getMessage();
            }
        }
        if(count($mensagem) > 0){
            return $mensagem;
        }
    }
    
    public function inscreverEmEvento($idEvento){
        return UsuarioEvento::inscreverEmEvento($this->idUsuario, $idEvento);
    }
    
    public static function consultarInscritosPorEvento($idEvento, $idStatusInscricao) {
        $mensagem = "";
        $usuarios = array();
        
        $dado = UsuarioDao::consultarInscritosPorEvento($idEvento, $idStatusInscricao);
        //print_r($dado);
        
        if($dado == null){
            $mensagem = "Nenhum usuário encontrado";
        }
        else{
            foreach ($dado as $obj){
                $usuario = new Usuario();
                foreach ($obj as $key => $value) {
                    $usuario->{$key} = $value;
                }
                $usuarios[] = $usuario;
            }
        }
        if($mensagem !== ""){
            return $mensagem;
        }
        else{
            return $usuarios;
        }
    }
    public static function credenciar($idUsuario, $idEvento) {
        return UsuarioDao::credenciar($idUsuario, $idEvento);
    }
}    