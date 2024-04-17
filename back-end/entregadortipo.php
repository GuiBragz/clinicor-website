<?php
session_start();
include_once 'connection.php';
include_once 'models/usuario.php';
include_once 'crud/read.php';
include_once 'controlador-login.php';

// Verifica se a sessão de usuário está definida
if (isset($_SESSION['usuario_email'])) {
    // Obtém o email do usuário da sessão
    $email = $_SESSION['usuario_email'];
    
    // Busca o usuário por email
    $usuario = buscarUsuarioPorEmail($email);
    
    // Verifica se o usuário foi encontrado
    if ($usuario !== null) {
        // Obtém o tipo do usuário
        $tipo = $usuario->getTipo();
        
        // Agora você pode usar $tipo conforme necessário
    } else {
        $tipo = null;
    }
} else {
    echo "<script>window.alert('Login não efetuado!');</script>";
    echo "<script>window.location.href = '../login.html';</script>";
}
?>