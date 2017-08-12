<?php

    require_once dirname(__FILE__).'/../phpDao/UsuarioDao.php';
    require_once dirname(__FILE__).'/UsuarioEvento.php';
    
class Usuario{
    private $idUsuario;
    private $cpf;
    private $senha;
    private $nome;
    private $email;
    private $matricula;
    private $administrador;
    private $avaliador;
    private $imagem;
    private $trabalhos;
    private $evento;
    
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
        return $this->imagem;
    }

    public function getTrabalhos() {
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
        if(strlen($cpf) == 14){
            $this->cpf = $cpf;
            return "";
        }
        else{
            return "O valor '".$cpf."' é inválido para CPF";
        }
    }

    public function setSenha($senha) {
        if(strlen($senha) >= 3){
            $this->senha = $senha;
            return "";
        }
        else{
            return "A senha deve possuir no mínimo três caracteres";
        }
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setEmail($email) {
        $this->email = $email;
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
                while($obj = $dado->fetch_assoc()) {
                    foreach ($obj as $key => $value) {
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

    public function salvar(){
        $mensagem = array();
        
        $dado = UsuarioDao::salvar($this->cpf, $this->senha, $this->nome, $this->email, $this->matricula, $this->avaliador, $this->imagem, $this->administrador, $this->idUsuario);
        
        if($dado == null){
            $mensagem[] = "Não foi possível cadastrar o usuário";
        }
        else{
            try{
                while($obj = $dado->fetch_assoc()) {
                    return $obj["idUsuario"];
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
        return UsuarioDao::inscreverEmEvento($this->idUsuario, $idEvento);
    }
}    