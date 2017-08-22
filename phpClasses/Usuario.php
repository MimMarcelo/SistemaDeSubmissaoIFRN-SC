<?php

    require_once dirname(__FILE__).'/_Util.php';
    require_once dirname(__FILE__).'/UsuarioEvento.php';
    require_once dirname(__FILE__).'/../phpDao/UsuarioDao.php';
    
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
        if(isset($cpf)){
            if(empty($cpf)){
                return "Informe o CPF";
            }
            else if(strlen($cpf) != 14){
                return "O CPF deve possuir 11 caracteres ";
            }
            else{
                $this->cpf = $cpf;
                return "";
            }
        }
        else{
            return "Informe o CPF";
        }
    }

    public function setSenha($senha, $senhaC) {
        if(isset($senha)){
            if(empty($senha)){
                return "Informe uma senha";
            }
            else if(strlen($senha) < 3){
                return "A senha deve possuir, no mínimo, 3 caracteres: ";
            }
        }
        else{
            return "Informe uma senha";
        }
        
        if(isset($senhaC)){
            if(empty($senhaC)){
                return "Confirme sua senha";
            }
            else{
                if(strcmp($senha, $senhaC) != 0){
                    return "As senhas não conferem";
                }
                else{
                    $this->senha = $senha;
                    return "";
                }
            }
        }
        else{
            return "Confirme sua senha";
        }
        
    }

    public function setNome($nome) {
        if(isset($nome)){
            if(empty($nome)){
                return "Informe o Nome";
            }
            else if(strlen($nome) < 3){
                return "O nome deve possuir, no mínimo, 3 caracteres";
            }
            else{
                $this->nome = $nome;
            }
        }
        else{
            return "Informe o nome";
        }
    }

    public function setMatricula($matricula) {
        $this->matricula = "";
        if(isset($matricula)){
            if(!empty($matricula)){
                $this->matricula = $matricula;
            }
        }
    }

    public function setEmail($email) {
        if(isset($email)){
            if(empty($email)){
                return "Informe o e-mail";
            }
            else{
                $this->email = $email;
            }
        }
        else{
            return "Informe o e-mail";
        }
        
    }

    public function setNivelAcesso($nivelAcesso){
        $this->administrador = 0;
        if(isset($nivelAcesso)){
            if(!empty($nivelAcesso)){
                $this->administrador = $nivelAcesso;
            }
        }
    }

    public function setAvaliador($avaliador) {
        $this->avaliador = 0;
        if(isset($avaliador)){
            if(!empty($avaliador)){
                $this->avaliador = $avaliador;
            }
        }
    }

    public function setImagem($imagem) {
        $this->imagem = "";
        $aux = "";
        if(strlen($imagem["name"]) > 0){
            $aux = _Util::validaImagem($imagem);
            if(strlen($aux) > 0){
                return $aux;
            }
            else{
                //RECUPERA A EXTENÇÃO DA IMAGEM UPADA
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);
                
                $aux = str_replace(".", "", $this->cpf);//O NOME DA IMAGEM É GERADO COM BASE NO CPF DO USUÁRIO
                $aux = str_replace("-", "", $aux);
                $aux .= ".".$ext[1];
                $this->imagem = $aux;
            }
        }
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
        else if(is_string($dado)){
            $mensagem[] = $dado;
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