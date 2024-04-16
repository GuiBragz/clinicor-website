<?php
include_once 'crud/create.php';
include_once 'models/usuario.php';

// Verifica se o método de requisição HTTP é do tipo "POST".
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário.
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Chama a função para cadastrar o usuário.
    cadastrarUsuario($email, $senha);
}
?>