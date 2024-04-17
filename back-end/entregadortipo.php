<?php
session_start();
include_once 'connection.php';
include_once 'models/usuario.php';
include_once 'crud/read.php';
include_once 'controlador-login.php';

// Verifica se a sessão de usuário está definida
if(isset($_SESSION['usuario_email'])) { 
    $email = $_SESSION['usuario_email'];
    $tipoUsuario = buscarUsuarioPorEmail($email)->getTipo();

    // Envia o tipo de usuário como resposta
    echo $tipoUsuario;
} else {
    // Se o usuário não estiver autenticado, exibe uma mensagem de erro
    http_response_code(401); // Defina o código de resposta HTTP como não autorizado
    echo "Usuário não autenticado";
}
?>