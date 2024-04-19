<?php


include_once 'crud/read.php';
include_once 'connection.php';


function alteradornavebar() {
    // Verifica se a sessão está ativa e se o email do usuário está definido na sessão
    if (isset($_SESSION['usuario_email'])) {
        // Email da sessão
        $email = $_SESSION['usuario_email'];

        // Supondo que buscarUsuarioPorEmail retorne um objeto $usuario
        $usuario = buscarUsuarioPorEmail($email);

        // Verifica o tipo do usuário e carrega a barra de navegação apropriada
        if ($usuario) {
            $tipo = $usuario->getTipo(); // Supondo que a função para obter o tipo seja getTipo()

            // Carrega a barra de navegação de acordo com o tipo de usuário
            if ($tipo == "paciente") {
                echo '<iframe src="barra_user.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
            } elseif ($tipo == "funcionario") {
                echo '<iframe src="barraFuncionario.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
            }elseif($tipo == "adm"){
                echo '<iframe src="barra_admoverpower.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
            }
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo '<iframe src="barra.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
    }
}

// Chamada da função para alterar a barra de navegação

?>