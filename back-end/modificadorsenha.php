<?php
include_once 'crud/read.php';
include_once 'models/usuario.php';
include_once 'crud/update.php';
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o código e a senha do formulário
    $codigo = $_POST["codigo"];
    $senha = $_POST["senha"];
    $senhaconfirma = $_POST["senha-confirmar"]; // Corrigido para corresponder ao nome do campo no formulário HTML

    if (buscarCodigoRecuperacao($codigo)) {
        if ($senhaconfirma == $senha) {
            modificadorSenha($senha, $codigo); // Corrigido a ordem dos parâmetros
            echo "<script>window.location.href = '../cadastro_email_enviado.html';</script>";
        } else {
            echo "<script>window.alert('A confirmação de senha está errada!');</script>";
            echo "<script>window.location.href = '../cadastro_nova_senha.html';</script>";
        }
    } else {
        echo "<script>window.alert('O código inserido está incorreto!');</script>";
        echo "<script>window.location.href = '../cadastro_nova_senha.html';</script>";
    }
} else {    
    echo "<script>window.alert('Ocorreu um erro, tente novamente mais tarde!');</script>";
    echo "<script>window.location.href = '../cadastro_nova_senha.html';</script>";
}
?>