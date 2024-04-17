<?php

class Consulta {
    private $consultaID;
    private $dataHora;
    private $medicoID;
    private $pacienteID;
    private $status;

    public function __construct($consultaID, $dataHora, $medicoID, $pacienteID, $status) {
        $this->consultaID = $consultaID;
        $this->dataHora = $dataHora;
        $this->medicoID = $medicoID;
        $this->pacienteID = $pacienteID;
        $this->status = $status;
    }

    public function getConsultaID() {
        return $this->consultaID;
    }

    public function setConsultaID($consultaID) {
        $this->consultaID = $consultaID;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }

    public function getMedicoID() {
        return $this->medicoID;
    }

    public function setMedicoID($medicoID) {
        $this->medicoID = $medicoID;
    }

    public function getPacienteID() {
        return $this->pacienteID;
    }

    public function setPacienteID($pacienteID) {
        $this->pacienteID = $pacienteID;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
?>