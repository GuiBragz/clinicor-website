<?php
include_once 'models/usuario.php';

session_start();

// Verifica se o usuário está logado (se existe um objeto de usuário na sessão)
if(isset($_SESSION['usuario'])) {
    // Obtém o objeto de usuário da sessão
    $usuario = $_SESSION['usuario'];

    // Exibe os dados do usuário
    echo "<h1>Dados do usuário</h1>";
    echo "Nome: " . $usuario->getNome() . "<br>";
    echo "CPF: " . $usuario->getCpf() . "<br>";
    echo "Email: " . $usuario->getEmail() . "<br>";
    echo "Tipo: " . $usuario->getTipo() . "<br>";
    echo "Data de Registro: " . $usuario->getDataRegistro()->format('d/m/Y') . "<br>";

    // Exemplo de manipulação do objeto de usuário
    // $usuario->setNome("Novo Nome");
    // $novoNome = $usuario->getNome();
} else {
    echo "Usuário não está logado.";
}
?>