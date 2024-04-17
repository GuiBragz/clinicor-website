<?php

class Medico {
    private $medicoID;
    private $nome;
    private $especialidade;
    private $horarioAtendimento;
    private $numConsultasRealizadas;
    private $funcionarioID;

    public function __construct($medicoID, $nome, $especialidade, $horarioAtendimento, $numConsultasRealizadas, $funcionarioID) {
        $this->medicoID = $medicoID;
        $this->nome = $nome;
        $this->especialidade = $especialidade;
        $this->horarioAtendimento = $horarioAtendimento;
        $this->numConsultasRealizadas = $numConsultasRealizadas;
        $this->funcionarioID = $funcionarioID;
    }

    public function getMedicoID() {
        return $this->medicoID;
    }

    public function setMedicoID($medicoID) {
        $this->medicoID = $medicoID;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEspecialidade() {
        return $this->especialidade;
    }

    public function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
    }

    public function getHorarioAtendimento() {
        return $this->horarioAtendimento;
    }

    public function setHorarioAtendimento($horarioAtendimento) {
        $this->horarioAtendimento = $horarioAtendimento;
    }

    public function getNumConsultasRealizadas() {
        return $this->numConsultasRealizadas;
    }

    public function setNumConsultasRealizadas($numConsultasRealizadas) {
        $this->numConsultasRealizadas = $numConsultasRealizadas;
    }

    public function getFuncionarioID() {
        return $this->funcionarioID;
    }

    public function setFuncionarioID($funcionarioID) {
        $this->funcionarioID = $funcionarioID;
    }
}
?>