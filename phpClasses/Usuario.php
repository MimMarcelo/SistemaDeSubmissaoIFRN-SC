<?php

    require_once dirname(__FILE__).'/../phpDao/UsuarioDao.php';
    require_once dirname(__FILE__).'/StatusInscricao.php';
    //require_once dirname(__FILE__).'/NivelAcesso.php';
    
class Usuario{
    private $idUsuario;
    private $cpf;
    private $senha;
    private $nome;
    private $email;
    private $matricula;
    private $nivelAcesso;
    private $statusInscricao;
    private $avaliador;
    private $trabalhos;
    
    public function getIdUsuario() {
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
        return $this->idNivelAcesso;
    }

    public function getStatusInscricao() {
        return $this->statusInscricao;
    }

    public function getAvaliador() {
        return $this->avaliador;
    }

    public function getTrabalhos() {
        return $this->trabalhos;
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
                        if($key == 'idNivelAcesso'){
                            $nivel = NivelAcesso::getNivelAcessoPorId($value);
                            if(is_array($nivel)){
                                $mensagem[] = $nivel;
                            }
                            else{
                                $usuario->nivelAcesso = $nivel;
                            }
                        }
                        else if($key == 'idStatusInscricao'){
                            $status = StatusInscricao::getStatusInscricaoPorId($value);
                            if(is_array($status)){
                                $mensagem[] = $status;
                            }
                            else{
                                $usuario->statusInscricao = $status;
                            }
                        }
                        else{
                            $usuario->{$key} = $value;
                        }
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

    
}    