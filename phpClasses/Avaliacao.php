<?php

    require_once dirname(__FILE__).'/../phpDao/AvaliacaoDao.php';

class Avaliacao{
    
    private $id;
    private $idTrabalho;
    private $idUsuario;
    private $nota;
    private $comentario;

    function __construct($id, $idTrabalho, $idUsuario, $nota, $comentario) {
        $this->id = $id;
        $this->idTrabalho = $idTrabalho;
        $this->idUsuario = $idUsuario;
        $this->nota = $nota;
        $this->comentario = $comentario;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getIdTrabalho(){
        return $this->idTrabalho;
    }

    public function setIdTrabalho($idTrabalho){
        $this->idTrabalho = $idTrabalho;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        if (is_array($idUsuario)) {
            $this->idUsuario = $idUsuario;
        }
    }

    public function getNota(){
        return $this->nota;
    }

    public function setNota($nota){
        $this->nota = $nota;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
    }
    
    /**
     * RETORNA TODAS AS AVALIAÇÕES JÁ CADASTRADAS
     */
    public static function getTodasAvaliacoes(){
        return AvaliacaoDao::getAvaliacoes(0, 0, 0, 0, 0, 2, 2, '', '');
    }
    
    /**
     * RETORNA AVALIAÇÕES DADOS ALGUNS PARÂMETROS
     * @param type $idEvento ID DO EVENTO PARA O QUAL O TRABALHO FOI SUBMETIDO
     * @param type $idTrabalho ID DO TRABALHO O QUAL SE DESEJA CONSULTAR AS AVALIAÇÕES
     * @param type $idAvaliacao ID DA AVALIAÇÃO QUE SE DESEJA CONSULTAR
     * @param type $idUsuario ID DO USUÁRIO AVALIADOR
     * @param type $idStatusTrabalho ID DO STATUS O QUAL O TRABALHO SE ENCONTRA
     * @param type $concluida 0 PARA AVALIAÇÕES PARCIAIS; 1 PARA AVALIAÇÕES CONCLUÍDAS; QUALQUER OUTRO NÚMERO PARA AMBAS AS SITUAÇÕES
     * @param type $ehFinal 0 PARA AVALIAÇÕES PARA APROVAÇÃO EM EVENTO; 1 PARA AVALIAÇÕES DE TRABALHOS DO EVENTO
     * @param type $titulo (PARTE DO) TÍTULO DO TRABALHO
     * @param type $resumo (PARTE DO) RESUMO DO TRABALHO
     */
    public static function getAvaliacoes($idEvento, $idTrabalho, $idAvaliacao, $idUsuario, $idStatusTrabalho, $concluida, $ehFinal, $titulo, $resumo) {
        return AvaliacaoDao::getAvaliacoes($idEvento, $idTrabalho, $idAvaliacao, $idUsuario, $idStatusTrabalho, $concluida, $ehFinal, $titulo, $resumo);
    }
    
    /**
     * REGISTRA AVALIAÇÃO PARA UM DADO TRABALHO
     * @param type $idUsuarioAvaliador ID DO USUÁRIO QUE REALIZOU A AVALIAÇÃO
     * @param type $idAvaliacao ID DA AVALIAÇÃO REALIZADA
     * @param type $nota NOTA ATRIBUÍDA PELO AVALIADOR
     * @param type $comentario COMENTÁRIOS ATRIBUÍDOS PELO AVALIADOR
     * @param type $final FLAG QUE REPRESENTA SE A AVALIAÇÃO FOI FINALIZADA (1) OU É PARCIAL (0)
     */
    public static function avaliarTrabalho($idUsuarioAvaliador, $idAvaliacao, $nota, $comentario, $final){
        return AvaliacaoDao::avaliarTrabalho($idUsuarioAvaliador, $idAvaliacao, $nota, $comentario, $final);
    }
    
    /**
     * CADASTRA UMA AVALIAÇÃO PARA UM DADO TRABALHO
     * @param type $idTrabalho ID DO TRABALHO A SER AVALIADO
     * @param type $ehFinal ESCOPO DA AVALIAÇÃO (0) SUBMISSÃO; (1) EVENTO
     * @param type $idUsuarios LISTA DE ID DE USUÁRIOS AVALIADORES
     */
    public static function cadastrarAvaliacao($idTrabalho, $ehFinal, $idUsuarios){
        return AvaliacaoDao::cadastrarAvaliacao($idTrabalho, $ehFinal, $idUsuarios);
    }
}