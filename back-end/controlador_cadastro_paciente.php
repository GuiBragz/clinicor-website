<?php
include_once 'crud/create.php';
include_once 'connection.php';
include_once 'models/pacientes.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $dataNasc = $_POST['dataNasc'];
    $genero = $_POST['genero'];
    $endereco = $_POST['endereco'];
    $numero_tel = $_POST['numero_tel'];
    $plano_saude_nome = $_POST['plano_saude_nome'];
    $plano_cobertura = $_POST['plano_cobertura'];

    if (cadastraPaciente($nome, $dataNasc, $genero, $endereco, $numero_tel, $plano_saude_nome, $plano_cobertura)) {
        header('location: ../MarcarConsulta.html');
        exit(); // Importante adicionar exit() após o redirecionamento
    } else {
        echo "<script>window.alert('Erro ao cadastrar paciente!');</script>";
        echo "<script>window.location.href = '../cadastro_paciente.html';</script>";
        exit(); // Importante adicionar exit() após o redirecionamento
    }
}
?>
