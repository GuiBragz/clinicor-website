<?php
session_start();
include_once 'connection.php';
include_once 'models/usuario.php';
include_once 'crud/read.php';




// Função para realizar o login
function login($email, $senha){

    // Se as credenciais estiverem corretas, busca o usuário e redireciona para a página home
    if(verificarCredenciaisNoBanco($email, $senha)){
        $usuario = buscarUsuarioPorEmail($email);
        $_SESSION['usuario_email'] = $email; // Definindo a variável de sessão com o email do usuário
        echo "<script>window.alert('Login realizado com sucesso!');</script>";
        echo "<script>window.location.href = '../home.html';</script>";

    } else {
        // Se as credenciais estiverem incorretas, exibe mensagem de erro e redireciona para a página de login
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
}else {
    echo "<script>window.alert('Ocorreu um erro, tente novamente mais tarde!');</script>";
    echo "<script>window.location.href = '../login.html';</script>";
}
?>
