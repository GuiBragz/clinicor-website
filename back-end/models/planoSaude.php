<?php

class PlanoSaude {
    private $planoSaudeID;
    private $nomePlano;
    private $cobertura;

    public function __construct($planoSaudeID, $nomePlano, $cobertura) {
        $this->planoSaudeID = $planoSaudeID;
        $this->nomePlano = $nomePlano;
        $this->cobertura = $cobertura;
    }

    public function getPlanoSaudeID() {
        return $this->planoSaudeID;
    }

    public function setPlanoSaudeID($planoSaudeID) {
        $this->planoSaudeID = $planoSaudeID;
    }

    public function getNomePlano() {
        return $this->nomePlano;
    }

    public function setNomePlano($nomePlano) {
        $this->nomePlano = $nomePlano;
    }

    public function getCobertura() {
        return $this->cobertura;
    }

    public function setCobertura($cobertura) {
        $this->cobertura = $cobertura;
    }
}
?>