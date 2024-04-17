<?php

class Funcionario {
    private $funcionarioID;
    private $nome;
    private $cargo;
    private $setor;
    private $dataContratacao;
    private $salario;
    private $usuarioID;

    public function __construct($funcionarioID, $nome, $cargo, $setor, $dataContratacao, $salario, $usuarioID) {
        $this->funcionarioID = $funcionarioID;
        $this->nome = $nome;
        $this->cargo = $cargo;
        $this->setor = $setor;
        $this->dataContratacao = $dataContratacao;
        $this->salario = $salario;
        $this->usuarioID = $usuarioID;
    }

    public function getFuncionarioID() {
        return $this->funcionarioID;
    }

    public function setFuncionarioID($funcionarioID) {
        $this->funcionarioID = $funcionarioID;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function getSetor() {
        return $this->setor;
    }

    public function setSetor($setor) {
        $this->setor = $setor;
    }

    public function getDataContratacao() {
        return $this->dataContratacao;
    }

    public function setDataContratacao($dataContratacao) {
        $this->dataContratacao = $dataContratacao;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
    }

    public function getUsuarioID() {
        return $this->usuarioID;
    }

    public function setUsuarioID($usuarioID) {
        $this->usuarioID = $usuarioID;
    }
}
?>