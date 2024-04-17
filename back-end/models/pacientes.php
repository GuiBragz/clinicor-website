<?php
class pacientes {

private $pacienteID;
private $nome;
private $dataNascimento;
private $genero;    
private $endereco;
private $numeroTelefone;
private $planoSaudeID;

private $usuarioId;

public function __construct($pacienteID, $nome, $dataNascimento, $genero, $endereco, $numeroTelefone, $planoSaudeID, $usuarioId ) {
    $this->pacienteID = $pacienteID;
    $this->nome = $nome;
    $this->dataNascimento = $dataNascimento;
    $this->genero = $genero;
    $this->endereco = $endereco;
    $this->numeroTelefone = $numeroTelefone;
    $this->planoSaudeID = $planoSaudeID;
    $this->usuarioId = $usuarioId;
}

public function getPacienteID() {
    return $this->pacienteID;}

public function getnome() {
    return $this->nome;}

public function getDataNascimento() {
    return $this->dataNascimento;}

public function getgenero() {
    return $this->genero;}

    public function getendereco() {
        return $this->endereco;}
    public function getNumeroTelefone() {
        return $this->numeroTelefone;}

    public function getPlanoSaudeID() {
        return $this->planoSaudeID;}

    public function getUsuarioId() {
        return $this->usuarioId;}
    


public function setPacienteId($pacienteID){
        $this->pacienteID = $pacienteID;}

public function setNome($nome){
        $this->nome = $nome;}



public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;}

public function setGenero($genero){
        $this->genero = $genero;}

public function setendereco($endereco){
        $this->endereco = $endereco;}

public function setnumeroTelefone($numeroTelefone){
        $this->numeroTelefone = $numeroTelefone;}

public function setPlanoSaudeID($planoSaudeID){
        $this->planoSaudeID =$planoSaudeID;}

public function setUsuarioId($usuarioId){
        $this->usuarioId = $usuarioId;}

}
?>