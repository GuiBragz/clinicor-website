<?php

include_once 'connection.php';
include_once 'models/usuario.php';
include_once 'crud/read.php';

// Função para realizar o login
function login($email, $senha){
    session_start();
    $usuario = buscarUsuarioPorEmail($email);
    
    if ($usuario !== null && password_verify($senha, $usuario->getSenha())) {
        $_SESSION['usuario_email'] = $email;
        echo "<script>window.alert('Login realizado com sucesso!');</script>";
        echo "<script>window.location.href = '../index.html';</script>";
    } else {
        echo "<script>window.alert('Email ou senha incorretos!');</script>";
        echo "<script>window.location.href = '../login.html';</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    // Executa a função de login
    login($email, $senha);
} else {
    echo "<script>window.alert('Ocorreu um erro, tente novamente mais tarde!');</script>";
    echo "<script>window.location.href = '../login.html';</script>";
}
?>