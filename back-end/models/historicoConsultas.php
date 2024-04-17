<?php

class HistoricoConsulta {
    private $historicoID;
    private $consultaID;
    private $diagnostico;
    private $receitaMedica;
    private $observacoes;

    public function __construct($historicoID, $consultaID, $diagnostico, $receitaMedica, $observacoes) {
        $this->historicoID = $historicoID;
        $this->consultaID = $consultaID;
        $this->diagnostico = $diagnostico;
        $this->receitaMedica = $receitaMedica;
        $this->observacoes = $observacoes;
    }

    public function getHistoricoID() {
        return $this->historicoID;
    }

    public function setHistoricoID($historicoID) {
        $this->historicoID = $historicoID;
    }

    public function getConsultaID() {
        return $this->consultaID;
    }

    public function setConsultaID($consultaID) {
        $this->consultaID = $consultaID;
    }

    public function getDiagnostico() {
        return $this->diagnostico;
    }

    public function setDiagnostico($diagnostico) {
        $this->diagnostico = $diagnostico;
    }

    public function getReceitaMedica() {
        return $this->receitaMedica;
    }

    public function setReceitaMedica($receitaMedica) {
        $this->receitaMedica = $receitaMedica;
    }

    public function getObservacoes() {
        return $this->observacoes;
    }

    public function setObservacoes($observacoes) {
        $this->observacoes = $observacoes;
    }
}
?>