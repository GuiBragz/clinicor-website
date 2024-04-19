<?php
include_once 'crud/create.php'; // Verifique o caminho correto do arquivo
include_once 'models/funcionario.php'; // Verifique o caminho correto do arquivo

if($_SERVER['REQUEST_METHOD']=="POST"){
    $nome = $_POST['nome'];
    $dataNasc = $_POST['data_nascimento'];
    $genero = $_POST['genero'];
    $endereco = $_POST['endereco'];
    $numero_tel = $_POST['numero_telefone'];
    $plano_saude_nome = $_POST['plano_saude_nome'];
    $plano_cobertura = $_POST['plano_cobertura'];


    if(cadastraPaciente($nome, $dataNasc, $genero, $endereco, $numero_tel, $plano_saude_nome, $plano_cobertura)){
        header('location:../../MarcarConsulta.html');
    }else{
        header('location:../../cadastro_paciente.html');
    }
}
?>