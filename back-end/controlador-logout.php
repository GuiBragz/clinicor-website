<?php
session_start();

// Função para realizar o logout
function realizarLogout() {
    // Limpa todas as variáveis de sessão
    $_SESSION = array();

    // Se necessário, destrua a sessão
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
}

// Chama a função para realizar o logout
realizarLogout();

echo "<script>window.alert('Logout realizado com sucesso!');</script>";
echo "<script>window.location.href = '../login.html';</script>";
exit; // Certifica-se de que o script não continue a ser executado após o redirecionamento
?>